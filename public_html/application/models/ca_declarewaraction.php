<?php defined('SYSPATH') OR die('No direct access allowed.');

class CA_Declarewaraction_Model extends Character_Action_Model
{

	protected $immediate_action = true;
	protected $warcost = 0;

	// Perform all the controls related to the action, both those shared
	// with all the actions that peculiar ones
	// @input: array of parameters
	// par[0]: char object
	// par[1]: object region that attacks
	// par[2]: attack type
	// par[3]: object region that receives the attack
	// par[4]: possible candidate for the regency
	// par[5]: maxattackers
	// par[6]: parameter 1
	// @output: TRUE = action available, FALSE = action not available
	//          $message contains the return message

	protected function check( $par, &$message )
	{


		// Cooldown on click

		$lastdeclarationsubmit =
		Character_Model::get_stat_d(
			$par[0] -> id,
			'lastdeclarationwarsubmit',
			null,
			null
		);

		if (
			$lastdeclarationsubmit -> loaded !== false
			and
			$lastdeclarationsubmit -> stat1 > time() )
			{
				// sets the cooldown
				$nexttime = mt_rand(60,120);
				Character_Model::modify_stat_d(
					$par[0] -> id,
					'lastdeclarationwarsubmit',
					0,
					null,
					null,
					true,
					time() + $nexttime
				);

				$message = kohana::lang( 'ca_declarewaraction.error-lastsubmitcooldown'); return false;
			}

		// set the cooldown
		$nexttime = mt_rand(60,120);
		Character_Model::modify_stat_d(
				$par[0] -> id,
				'lastdeclarationwarsubmit',
				0,
				null,
				null,
				true,
				time() + $nexttime
		);

		if ( ! parent::check_( $par, $message ) )
		{ return false; }

		////////////////////////////////
		// check data
		////////////////////////////////

		if ( !$par[3] -> loaded )
		{ $message = kohana::lang( 'global.error-regionunknown'); return false;}

		// check if the region � disabled

		if ( $par[3] -> status == 'disabled' )
		{ $message = kohana::lang( 'global.operation_not_allowed'); return false;}

		// The kingdom that launches the attack � at war?
		$attackingkingdomrunningwars = Kingdom_Model::get_kingdomwars( $par[1] -> kingdom_id, 'running');

		if (count($attackingkingdomrunningwars) == 0 )
		{ $message = kohana::lang( 'ca_declarewaraction.error-attackingkingdomisnotinwar'); return false;}

		// The kingdom that � defends � at war?
		$defendingkingdomrunningwars = Kingdom_Model::get_kingdomwars( $par[3] -> kingdom_id, 'running');
		if (count($defendingkingdomrunningwars) == 0 )
		{ $message = kohana::lang( 'ca_declarewaraction.error-defendingkingdomisnotinwar'); return false;}

		// Are the two kingdoms in the same war?

		if ($attackingkingdomrunningwars[0]['war'] -> id  != $defendingkingdomrunningwars[0]['war'] -> id)
		{ $message = kohana::lang( 'ca_declarewaraction.error-defendingkingdomisnotinsamewar'); return false;}

		// At least 2 days must have passed since the last declaration of war
		if ( (time() - $attackingkingdomrunningwars[0]['war']->start) < ( kohana::config('medeur.war_cooldownbeforeattacks') * 24 * 3600 ) )
		{ $message = kohana::lang( 'ca_declarewaraction.error-youcannotattackyet'); return false;}

		// Is the diplomatic relationship with the kingdom in which it attacked � hostile?  

		$diplomacyrelation = Diplomacy_Relation_Model::get_diplomacy_relation( $par[1] -> kingdom_id, $par[3] -> kingdom_id);
		if ($diplomacyrelation['type'] != 'hostile')
		{ $message = kohana::lang( 'ca_declarewaraction.error-diplomacyrelationisnothostile'); return false;}

		// Capital conquest: check if the kingdom has at least
		// 3 regions

		if ( $par[2] == 'conquer_r' and $par[3] -> capital and count( $par[3] -> kingdom -> regions ) > 3 )
		{$message = kohana::lang('ca_declarewaraction.mustreduceownedregions');return false;}

		////////////////////////////////
		// Regency candidate check
		// if a capital is attacked.
		////////////////////////////////

		if ( $par[2] == 'conquer_r' and $par[3] -> capital and Character_Role_Model::check_eligibility( $par[4], 'king', null, $message ) == false  )
		{ $message = kohana::lang('ca_declarewaraction.kingcandidatenoneligible') . ':' . $message; return false;}

		if ( $par[2] == 'conquer_r' and $par[3] -> capital and $par[4] -> id == $par[0] -> id )
		{ $message = kohana::lang('ca_declarewaraction.error-youcannotbetheregentcandidate') . ':' . $message; return false;}

		// The realm that declares the attack cannot� be under attack.
		$data = null;
		$iskingdomfighting = Kingdom_Model::is_fighting( $par[1] -> kingdom_id, $data ) ;
		if ( $iskingdomfighting == true )
		{ $message = kohana::lang( 'ca_declarewaraction.attacker_isfighting', kohana::lang($par[1]->name) ) ; return false; }

		// If the kingdom to attack �already� under attack, not � possible
		// to declare hostile actions, if you are attacking, ok.

		$iskingdomfighting = Kingdom_Model::is_fighting( $par[3] -> kingdom_id, $data );
		if ( $iskingdomfighting == true and $data['defending'] == true )
		{	$message = kohana::lang( 'ca_declarewaraction.defender_isfighting',
			kohana::lang( $par[3] -> kingdom -> name) ) ; return false;	}

		// In the region there� a battlefield? If yes� you can't� attack
		// (you can't� attack the same region simultaneously

		$battlefield = $par[3] -> get_structure('battlefield');
		if ( !is_null( $battlefield ) )
		{ $message = kohana::lang( 'ca_declarewaraction.error-battlefieldpresent' ) ; return false; }

		// cost: if who launches the attack � who launched the war or one of his allies
		// the cost � 0

		$diplomacyrelationwithkingdomthatdeclaredwar = Diplomacy_Relation_Model::get_diplomacy_relation(
			$par[1] -> kingdom_id , $attackingkingdomrunningwars[0]['war'] -> source_kingdom_id
		);

		if (
			$attackingkingdomrunningwars[0]['war'] -> source_kingdom_id == $par[1] -> kingdom_id
			or
			$diplomacyrelationwithkingdomthatdeclaredwar['type'] == 'allied'
		)
			$this -> warcost = 0;
		elseif ( $par[2] == 'raid' or $par[2] == 'conquer_r' )
			$this -> warcost = Battle_Type_Model::compute_costs_kingdom();

		if ($this -> warcost > 0 )
		{
			$royalpalace = $par[1] -> kingdom -> get_structure('royalpalace');

			if ( $royalpalace -> get_item_quantity( 'silvercoin' ) < $this -> warcost )
			{
				$message = kohana::lang( 'ca_declarewaraction.error-notenoughfunds', $this -> warcost );
				return false;
			}
		}

		// Not � possible to raid the relic of one's religion.
		/*
		if ( $par[2] == 'raid' and $par[6] == 'relic_' . $par[0] -> church -> name)
		{
			$message = kohana::lang( 'ca_declarewaraction.error-cantraidownrelic');
			return false;
		}
		*/
				
		return true;

	}

	protected function append_action( $par, &$message ) {}

	function complete_action( $data )
	{

		// sending event to the King of the attacked kingdom

	}

	public function execute_action ( $par, &$message)
	{

		$defendingregion = ORM::factory('region', $par[3] -> id );
		$role_def = $defendingregion -> get_roledetails( 'king' );

		if (is_null($role_def))
			$king_def = null;
		else
			$king_def = ORM::factory('character', $role_def -> character_id );

		$king_att = ORM::factory('character', $par[0] -> id );
		$role_att = $king_att -> get_current_role();

		//////////////////////////////////////
		// I add a record in battle
		//////////////////////////////////////

		$attackingkingdomrunningwars = Kingdom_Model::get_kingdomwars( $par[1] -> kingdom_id, 'running');

		$wd = new Battle_Model();
		$wd -> source_character_id = $par[0] -> id;
		$wd -> kingdomwar_id = $attackingkingdomrunningwars[0]['war'] -> id;
		if ( is_null($king_def) )
			$wd -> dest_character_id = null;
		else
			$wd -> dest_character_id = $king_def -> id;
		$wd -> dest_region_id = $par[3] -> id;
		$wd -> source_region_id = $par[1] -> id;
		$wd -> type = $par[2];
		$wd -> maxattackers = $par[5];
		$wd -> param1 = $par[6];

		if ( !is_null( $par[4] ) )
			$wd -> kingcandidate = $par[4] -> id;
		else
			$wd -> kingcandidate = null;

		$wd -> status = 'running';
		$wd -> timestamp = time();
		$wd -> save ();

		$wdr = new Battle_Report_Model();
		$wdr -> battle_id = $wd -> id;
		$wdr -> save();

		//////////////////////////////////////
		// I take the money out
		//////////////////////////////////////

		$royalpalace = $par[1] -> kingdom -> get_structure('royalpalace');
		$royalpalace -> modify_coins( - $this -> warcost, 'declarewaraction' );

		//////////////////////////////////////
		// Inform the defending king
		// in the case of Raid, the King � informed
		// only when the battleraid � ready
		//////////////////////////////////////

		if ( $par[2] != 'raid' )
		{
			if (!is_null($king_def))
				Character_Event_Model::addrecord(
					$king_def->id,
					'normal',
					'__events.wardeclaration_event2' .
					';__'. $king_att -> region -> kingdom -> get_name()  .
					';__battle.' . $par[2] .
					';__' . $par[3] -> name,
					'evidence'
					);
		}

		//////////////////////////////////////
		// Inform the attacking King
		//////////////////////////////////////
		if (!is_null( $king_def ))
			Character_Event_Model::addrecord(
				$king_att->id,
				'normal',
				'__events.wardeclaration_event3' .
				';__battle.' . $par[2] .
				';__'. $par[3] -> name .
				';__'. $king_def -> region -> kingdom -> get_name() ,
				'evidence'
				);

		//////////////////////////////////////
		// Add event to auctioneer
		// except raid
		//////////////////////////////////////

		if ( $par[2] != 'raid' )
		{
			Character_Event_Model::addrecord(
				null,
				'announcement',
				'__events.wardeclaration_announcement2' .
				';__' . $king_att -> region -> kingdom -> get_article() .
				';__' . $king_att -> region -> kingdom -> get_name()  .
				';__' . $par[3] -> kingdom -> get_article3() .
				';__' . $par[3] -> kingdom -> get_name()  .
				';__battle.' . $par[2] .
				';__' . $par[3] -> name,
				'evidence'
			);
		}

		// Schedule an action to build the battlefield

		$a = new Character_Action_Model();
		$a -> character_id = $king_att -> id;
		$a -> action = 'createcdb';
		$a -> blocking_flag = false;
		$a -> cycle_flag = false;
		$a -> status = 'running';

		if ( $par[2] == 'raid' )
			$a -> starttime = time() + 16 * 3600;
		else
			$a -> starttime = time() + 48 * 3600;

		$a -> endtime = $a -> starttime;
		$a -> param1 = $wd -> id;
		$a -> save ();

		$message = sprintf( kohana::lang( 'ca_declarewaraction.wardeclaration_ok'),  kohana::lang($par[3]->name) );

		return true;

	}
}
