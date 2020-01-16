<?php defined('SYSPATH') OR die('No direct access allowed.');

class CA_Restrain_Model extends Character_Action_Model
{
	
	protected $cancel_flag = false;
	protected $immediate_action = false;
	
	const RESTRAIN_COOLDOWN = 86400; // 1 day
	const MAXRESTRAINPERIOD = 168; 
	
	protected $basetime       = 1;   // 1 hour
	protected $attribute      = 'none';  // attribute strength
	protected $appliedbonuses = array ( 'none' ); // bonuses to be applied
	
	public function __construct()
	{		
		parent::__construct();
		// this action is not blocking for other char actions.
		$this->blocking_flag = false;		
		return $this;
	}
	
	/**
  *	Carries out all controls related to move, both shared
	* with all the actions that those peculiar to the dig
	* @param: par
	*  par[0] = char that freezes
	*  par[1] = char to lock
	*  par[2] = n. hours
	*  par[3] = reasons
	* @return: TRUE = action available, FALSE = action not available
	*
	*/
	
	protected function check( $par, &$message )
	{ 
		$message = "";
		
		//var_dump ($par[3]); exit; 
		
		if ( ! parent::check( $par, $message, $par[0] -> id, $par[1] -> id ) )					
			return false;

		///////////////////////////////////////////////////////////////////////
		// data control
		///////////////////////////////////////////////////////////////////////
		
		if ( ! $par[0] -> loaded )
		{ $message = kohana::lang('global.operation_not_allowed'); return FALSE; }
		
		if ( !$par[1] -> loaded )
		{ $message = kohana::lang('global.error-characterunknown'); return FALSE; }				
		
		///////////////////////////////////////////////////////////////////////		
		// the reason is mandatory.
		///////////////////////////////////////////////////////////////////////
		
		if ( strlen( $par[3] ) == 0 )
		{ $message = kohana::lang('ca_restrain.reasonmandatory' ) ; return FALSE; }
		
		///////////////////////////////////////////////////////////////////////
		// control of blocking hours
		///////////////////////////////////////////////////////////////////////

		if ( $par[2] < 1 or $par[2] > self::MAXRESTRAINPERIOD )
		{ $message = kohana::lang('ca_restrain.durationincorrect'); return FALSE; }
		
		///////////////////////////////////////////////////////////////////////		
		// It is not possible to lock an already locked char		
		///////////////////////////////////////////////////////////////////////
		
		if ( Character_Model::is_restrained( $par[1] -> id ) )
		{ $message = kohana::lang('ca_restrain.alreadyrestrained', $par[1] -> name); return FALSE; }
	
		///////////////////////////////////////////////////////////////////////		
		// you cannot lock yourself
		///////////////////////////////////////////////////////////////////////
		
		if ( $par[1]->id == $par[0]->id )
			{ $message = kohana::lang('ca_restrain.selfaction'); return FALSE; }
			
		///////////////////////////////////////////////////////////////////////		
		// a regent, head of church cannot be locked
		///////////////////////////////////////////////////////////////////////
		
		$role = $par[1] -> get_current_role() ; 
		
		if ( !is_null( $role) and in_array( $role -> tag, array( 'church_level_1', 'king' )  ) )
		{ $message = kohana::lang('ca_restrain.notenoughpower' ); return FALSE; }
		
		///////////////////////////////////////////////////////////////////////		
		// To lock a char, it must be in the kingdom
		///////////////////////////////////////////////////////////////////////
		
		if ( ! $par[1] -> is_inkingdom( $par[0] -> region -> kingdom ) )		
		{ $message = kohana::lang('ca_restrain.isnotinkingdom', $par[1] -> name ); return FALSE; }
		
		//////////////////////////////////////////////////////////////////////
		// the player has the necessary items
		//////////////////////////////////////////////////////////////////////
		
		if ( ! Character_Model::has_item( $par[0]->id, 'paper_piece', 1 ) ) 
		{ $message = kohana::lang('charactions.paperpieceneeded'); return FALSE; }				

		//////////////////////////////////////////////////////////////////////
		// The realm of the player is at war with the realm of those who try to
		// hold him?
		//////////////////////////////////////////////////////////////////////
		
		$restrainerkingdomrunningwars = Kingdom_Model::get_kingdomwars( $par[0] -> region -> kingdom_id, 'running');
		$restrainedkingdomrunningwars = Kingdom_Model::get_kingdomwars( $par[1] -> region -> kingdom_id, 'running');
		
		if (
			count($restrainerkingdomrunningwars) > 0 
			and  
			count($restrainedkingdomrunningwars) > 0 
			and 
			$restrainerkingdomrunningwars[0]['war'] -> id == $restrainedkingdomrunningwars[0]['war'] -> id
		)
		{ $message = kohana::lang( 'charactions.error-characterisofenemykingdom'); return false;}	
			
		//////////////////////////////////////////////////////////////////////
		// the player is recovering but is he in the battlefield?
		//////////////////////////////////////////////////////////////////////
		
		if ( Character_Model::is_recovering( $par[1] -> id ) and Character_Model::is_fighting( $par[1] -> id ) == true )
		{ $message = kohana::lang('ca_restrain.error-charisfighting', $par[1] -> name); return FALSE; }				
		
		//////////////////////////////////////////////////////////////////////
		// Cooldown is 24 hour
		//////////////////////////////////////////////////////////////////////
		
		$stat = Character_Model::get_stat_d( $par[1] -> id, 'lastrestrain', $par[0] -> region -> kingdom_id );
		if ( $stat -> loaded and time() - ( 24 * 3600 ) < $stat -> stat1 )
		{ $message = kohana::lang('ca_restrain.error-restraincooldown', $par[1] -> name); return FALSE; }				
		
		return true;
	
	}


	// Function for inserting the action into the DB.
	// This function only hangs one action _not executes it_
	// At the moment no immediate actions are foreseen
	// @input: $par[0] = structure, $par[1] = char
	// @output: TRUE = action available, FALSE = action not available
	//          $messages contains errors in case of FALSE
	
	protected function append_action( $par, &$message ) 
	{
	
		$paper_piece = Item_Model::factory( null, 'paper_piece' );
		$paper_piece -> removeitem( 'character', $par[0] -> id, 1 );
		
		$this -> character_id = $par[1] -> id;
		$this -> starttime = time();
		$this -> status = "running";			
		$this -> param1 = $par[0] -> region_id;		
		$this -> param2 = $par[0] -> id;
		$this -> param3 = $par[0] -> region -> kingdom_id;
		$this -> param5 = $par[3];
		$this -> endtime = $this -> starttime + $this -> get_action_time( $par[0] ) * $par[2];		
		$this -> save();
		
		// save stat
		
		$par[1] -> modify_stat(
			'lastrestrain',
			0,
			$par[0] -> region -> kingdom_id,
			null,
			null,
			null,
			true );
		
		// event
		
		Character_Event_Model::addrecord( 
			$par[1] -> id,
			'normal', 
			'__events.restrain_targetinfo;' . 
			$par[2] . ';' .
			$par[3],
			'evidence'
		);
		
		$message = kohana::lang('ca_restrain.ok');
		
		return true;
		
	}

	// Execution of the action. 
	
	public function complete_action( $data ) {
	
		// Save the statistic, mark the end of the restrain.
		
		$character = ORM::factory('character', $data -> character_id );
		$character -> modify_stat(
			'lastrestrain',
			0,
			$data -> param3,
			null,
			true,
			time()
			);			
	}
	
	protected function execute_action() {}
	
	public function cancel_action( $data ){}
	
	// This function constructs a message to be displayed
	// waiting for the action to complete.
	
	public function get_action_message( $type = 'long') 
	{
		$pending_action = $this->get_pending_action();
		$message = "";	
		$target = ORM::factory('character', $pending_action -> param1 );		
		
		
		if ( $pending_action -> loaded )
		{
			if ( $type == 'long' )		
			$message = '__regionview.restrain_longmessage;' . $target->name;
			else
				$message = '__regionview.restrain_shortmessage';
		}
		return $message;
	
	}
	
}
