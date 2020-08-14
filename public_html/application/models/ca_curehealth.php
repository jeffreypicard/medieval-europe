<?php defined('SYSPATH') OR die('No direct access allowed.');


class CA_Curehealth_Model extends Character_Action_Model
{
	// Glut and energy needed to perform the action
	const DELTA_GLUT = 10;
	const DELTA_ENERGY = 10;
	// Faith points required to perform the action
	// They must be present in the structure governed by the priest
	const REQUESTEDFP = 50;
	
	// Minimum level of faith required from the char being treated
	// and to the priest who performs the treatments
	/*const CHAR_FAITHLEVELREQUESTED = 75;*/
	const PRIEST_FAITHLEVELREQUESTED = 90;
	
	// Is the action cancelable
	protected $cancel_flag = true;
	// Not immediate action
	protected $immediate_action = false;

	protected $basetime       = 2;  
	protected $attribute      = 'intel';  // intelligence attribute
	protected $appliedbonuses = array ( 'workerpackage' ); // bonuses to be applied

	// The action requires the character to wear
	// a certain equipment
	protected $requiresequipment = true;
	protected $controlledstructure = null;

	// Equipment or clothing needed by role
	protected $equipment = array
	(
		'church_level_1' => array
		(
			'head' => array
			(
				'items' => array('mitra_rome','panzva_turnu','hat_cairo','hat_kiev','hat_norse'),
				'consume_rate' => 'high',
			),
			'right_hand' => array
			(
				'items' => array('mysticrod_turnu','scepter_kiev','pastoral_rome', 'mysticrod_cairo','scepter_norse'),
				'consume_rate' => 'high',
			),
			'body' => array
			(
				'items' => array('tunic_church_level_1_rome', 'tunic_church_level_1_turnu', 'tunic_church_level_1_kiev', 'tunic_church_level_1_cairo','tunic_church_level_1_norse'),
				'consume_rate' => 'high',
			),
			'feet' => array
			(
				'items' => array('any'),
				'consume_rate' => 'high',
			)
		),
		'church_level_2' => array
		(
			'head' => array
			(
				'items' => array('mitra_rome','panzva_turnu','hat_cairo','hat_kiev','hat_norse'),
				'consume_rate' => 'high',
			),
			'right_hand' => array
			(
				'items' => array('mysticrod_turnu','scepter_kiev','pastoral_rome', 'mysticrod_cairo','scepter_norse'),
				'consume_rate' => 'high',
			),
			'body' => array
			(
				'items' => array('tunic_church_level_2_rome', 'tunic_church_level_2_turnu', 'tunic_church_level_2_kiev', 'tunic_church_level_2_cairo','tunic_church_level_2_norse'),
				'consume_rate' => 'high',
			),
			'feet' => array
			(
				'items' => array('any'),
				'consume_rate' => 'high'
			)		),
		'church_level_3' => array
		(
			'head' => array
			(
				'items' => array('mitra_rome','panzva_turnu','hat_cairo','hat_kiev','hat_norse'),
				'consume_rate' => 'high'
			),
			'right_hand' => array
			(
				'items' => array('mysticrod_turnu','scepter_kiev','pastoral_rome', 'mysticrod_cairo','scepter_norse'),
				'consume_rate' => 'high',
			),
			'body' => array
			(
				'items' => array('tunic_church_level_3_rome', 'tunic_church_level_3_turnu', 'tunic_church_level_3_kiev', 'tunic_church_level_3_cairo','tunic_church_level_3_norse'),
				'consume_rate' => 'high',
			),
			'feet' => array
			(
				'items' => array('any'),
				'consume_rate' => 'high',
			)
		),
		'church_level_4' => array
		(
			'right_hand' => array
			(
				'items' => array('holybook'),
				'consume_rate' => 'high',
			),
			'body' => array
			(
				'items' => array('tunic_church_level_4_rome', 'tunic_church_level_4_turnu', 'tunic_church_level_4_kiev', 'tunic_church_level_4_cairo','tunic_church_level_4_norse'),
				'consume_rate' => 'high',
			),
			'feet' => array
			(
				'items' => array('any'),
				'consume_rate' => 'high',
			),
		),
	);
	
	
	// Carries out all checks relating to disease treatment, both shared
	// with all the actions that those peculiar to the cure
	// @input: 
	// $par[0] = char who heals
	// $par[1] = char who is healed
	// @output: TRUE = stock available, FALSE = action not available
	//          $messages contains errors in case of FALSE
	
	protected function check( $par, &$message )
	{ 
		$message = "";
		
		$has_dogma_bonus = Church_Model::has_dogma_bonus($par[0] -> church_id, 'curehealthextended');	
				
		// Check: controls parent model (check_equipment)
		if ( ! parent::check_( $par, $message, $par[0] -> id, $par[1] -> id ) )					
			return false;
		
		// Check: the char that cures does not have a religious role
		if ( ! $par[0] -> has_religious_role() )
		{ $message = Kohana::lang("global.operation_not_allowed"); return false; }		
		
		$role = $par[0] -> get_current_role();		
		$this -> controlledstructure = $role -> get_controlledstructure();  
		
		// Check: char who cures does not exist
		// Check: char that is cured does not exist
		// Check: Structure where cure is not available
		
		if
		( 
			!$par[0] -> loaded or 
			!$par[1] -> loaded			
		)
		{ $message = Kohana::lang("global.operation_not_allowed"); return false; }	

		
		// Check: the char that cures does not have enough energy
		// Check: the char who cures does not have enough glut
		if
		(
			$par[0] -> energy < (self::DELTA_ENERGY)  or
			$par[0] -> glut < (self::DELTA_GLUT)
		)
		{ $message = Kohana::lang("charactions.notenoughenergyglut"); return false; }
		
		// Check: the caregiver does not have sufficient faith level
		$fl = $par[0] -> get_stat( 'faithlevel' );
		if ( $fl -> value < self::PRIEST_FAITHLEVELREQUESTED )
		{ $message = Kohana::lang("global.error-charisnotfaithfulenough", self::PRIEST_FAITHLEVELREQUESTED); return false; }
		
		// Check: the church does not have the dogma bonus
		// Check: the chars are not in the same region as the religious structure		
		if 
		( 
			! $has_dogma_bonus and
			(		
				$par[0] -> position_id != $this -> controlledstructure -> region_id
			)
		)
		{ 
			$message = Kohana::lang("ca_cure.error-farfromstructure"); 
			return false; 
		}
				
		// Check: the chars are in different regions
		
		if ( $par[0] -> position_id != $par[1] -> position_id )
		{ 
			$message = Kohana::lang("ca_cure.error-charsarenotinsamelocation"); 
			return false; 
		}	
						
		// Check: the char being treated is engaged in another action
		// unless it's recovery
		
		$pendingaction = Character_Action_Model::get_pending_action( $par[1] ); 
		if ( !is_null( $pendingaction ) and Character_Model::is_recovering( $par[1] -> id ) == false )		
		{ $message = Kohana::lang("global.error-characterisbusy", $par[1] -> name ); return false; }
				
		// Check: the structure does not have enough FP to cure the char
		$fp = Structure_Model::get_stat_d( $this -> controlledstructure -> id, 'faithpoints' ); 		
		if ( ! $fp -> value or	$fp -> value < self::REQUESTEDFP )
		{ $message = Kohana::lang("global.error-notenoughfp", self::REQUESTEDFP); return false; }
		
		// Check: Does the one who cures have the medical kit?
		if ( ! Character_Model::has_item( $par[0] -> id, 'medicalkit') )
		{ $message = Kohana::lang("ca_cure.error_no_medikit" ); return false; }
		
		// Check: religion has no dogma bonus
		// Check: the priest is level 1,2,3 or 4		
		
		if 
		(
			! $has_dogma_bonus and
			in_array ($role->tag, array('church_level_1', 'church_level_2', 'church_level_3', 'church_level_4'))
		)
		{ $message = Kohana::lang("global.operation_not_allowed"); return false; }
		
		// Check: the char to be treated is an atheist 
		// Check: the church does not have the dogma bonus
		if 
		(
			$par[1] -> church -> name == 'nochurch' and ! $has_dogma_bonus
		)
		{ $message = Kohana::lang("ca_cure.error-cantcureatheist"); return false; }	
		
		
		// Check: the character to be treated has a religion different from the char he is healing		
		if
		(
			$par[1] -> church_id != $par[0] -> church_id 
			and
			$par[1] -> church -> name != 'nochurch'
		)
		{ $message = Kohana::lang("ca_cure.error-cantcuredifferentfaithfollower"); return false; }				
		
		// All checks have been passed
		
		return true;
	}

	/*
	* Function for inserting the action into the DB.
	* This function only has one action _not executes it_
	* @param  array    $par       $par[0] = char who cures, $par[1] = char who is cured
	*                             $par[1] = structure of the char that cures
	* @output boolean             TRUE = stock available, FALSE = action not available
	* @output string   $messages  contains errors in case of FALSE
	*/
	
	protected function append_action( $par, &$message )
	{
		
		// I charge the eventual disease cure bonus
		$church = ORM::factory('church', $this -> controlledstructure->structure_type->church_id );
		
		
		$has_dogma_bonus = Church_Model::has_dogma_bonus($this -> controlledstructure->structure_type->church_id,'curehealthextended');
		
		// Set the cure time based on: atheist / faithful
		if 
		(
			$par[1] -> church -> name == 'nochurch' and 
			$has_dogma_bonus
		)
		{ $this -> basetime = 4; }
		
		if 
		(
			$par[1] -> church -> name != 'nochurch' and 
			$has_dogma_bonus
		)
		{ $this -> basetime = 2; }
		
		// If the char is recovering health, the recovery action must be canceled.
		
		$was_recovering = false;
		
		if ( Character_Model::is_recovering( $par[1] -> id) == true )
		{
			$was_recovering = true;
			kohana::log('debug', '-> Trying to cancel recovering action...');
			$rc = Character_Action_Model::cancel_pending_action( $par[1] -> id, true, $message );
			if ($rc == false )
				return $rc;
		}
		
		/////////////////////////////////////////////////
		// Save an action blocking for those who need to heal
		// only if the priest is not healing himself
		/////////////////////////////////////////////////
		
		if ( $par[0]-> id != $par[1] -> id )
		{
		
			$this -> character_id = $par[0] -> id;
			$this -> starttime = time();			
			$this -> status = "running";	
			
			// save the char of those who care	
			$this -> param1 = $par[0] -> id;
			// save the char of those who are treated
			$this -> param2 = $par[1] -> id;		
			// save the id of the religious structure		
			$this -> param3 = $this -> controlledstructure -> id;
			
			if ( $was_recovering == true )
				$this -> param4 = true;
		
			$this -> endtime = $this -> starttime + $this -> get_action_time( $par[0], $par[1] );
			$this -> save();		
		}
		
		/////////////////////////////////////////////////
		// Save an action blocking for the cured		
		/////////////////////////////////////////////////
		
		$a = new Character_Action_Model();		
		$a -> character_id = $par[1] -> id;
		$a -> action = 'curehealth';
		$a -> starttime = time();			
		$a -> status = "running";	
		
		// Id of the char of those who cure	
		$a -> param1 = $par[0] -> id;
		// Id of the char of those who are cured
		$a -> param2 = $par[1] -> id;	
		// Id of the religious structure controlled by the healer
		$a -> param3 = $this -> controlledstructure -> id;
		
		if ( $was_recovering == true )
			$a -> param4 = true;
		
		
		$a -> endtime = $a->starttime + $this -> get_action_time( $par[0], $par[1] );
		$a -> save();		

		// Remove medical kit
		$i = Item_Model::factory( null, 'medicalkit' );
		$i -> removeitem( "character", $par[0]->id, 1 );
		
		// priest cache refresh ...		
		My_Cache_Model::delete(  '-charinfo_' . $par[0] -> id . '_currentpendingaction');				
		
		// Consume the faith points from the controlled structure
		// from the char that cures		
		
		$this -> controlledstructure -> modify_stat
		(
			'faithpoints', 
			- self::REQUESTEDFP
		);
		
		// Message to be displayed to the treating person
		$message = kohana::lang('ca_cure.info-cure-ok');		
		
		// Notification of start of treatment events
		// *************************************
		// Event to the char that is cured
		Character_Event_Model::addrecord
		( 
			$par[1] -> id, 
			'normal', 
			'__events.curestartedtarget'.';'.$par[0] -> name
		);
		// Notification to the char who cures		
		Character_Event_Model::addrecord
		( 
			$par[0] -> id, 
			'normal', 
			'__events.curestartedsource'.';'.$par[1] -> name
		);
		
		// Append successful
		return true;
	}

	/*
	* Execution of the health care action.
	* This function is called when a complete_expired_action is called
	* and manages the actions entered in the character_actions
	* - The parameters are loaded from the database
	* - The action is performed according to the parameters
	* - The action is put in the completed state
	* @param  array    $data      [0] = id char who cures, [1] = id char being cured for
	*                             [2] = id structure of the char that cures
	* @output boolean             TRUE = stock available, FALSE = action not available
	* @output string   $messages  contains errors in case of FALSE
	*/
	
	public function complete_action( $data )
	{
		
		kohana::log('debug', '-> Completing action curedisease for char: ' . $data -> character_id );
		// Char to whom the action to be completed is linked
		$charaction = ORM::factory('character', $data -> character_id );
		// Char who performed the cure
		$charsource = ORM::factory('character', $data -> param1 );
		// Char who has been cured
		$chartarget = ORM::factory('character', $data -> param2 );
		// Structure that is controlled by the care provider
		$structure  = ORM::factory('structure', $data -> param3 );

		/*******************************
		* Actions related to the caregiver
		********************************/
		
		if ( $charaction -> id == $charsource -> id )
		{			
			
			// Consumption of worn items / clothes
			
			Item_Model::consume_equipment( $this->equipment, $charsource );					
			// I update the stat of the char he cares for
			
			$charsource -> modify_stat
			( 
				'cure', 
				+1, 
				$structure -> structure_type -> church -> id
			);
				
			// I update the stat of the structure controlled by the healer
			
			$structure ->  modify_stat
			( 
				'cure',
				+1
			);
			
			// I subtract energy and glut
			
			$charsource -> modify_energy( - self::DELTA_ENERGY, false, 'curehealth' );
			$charsource -> modify_glut( - self::DELTA_GLUT );
			$charsource -> save();
			
		}
				
		/*****************************************
		 * Actions related to those who have been treated
		 *****************************************/
		
		if ( $charaction -> id == $chartarget -> id )
		{	
			// I charge the eventual disease cure bonus
			
			$church = ORM::factory('church', $structure->structure_type->church_id );			
			$has_dogma_bonus = Church_Model::has_dogma_bonus($structure->structure_type->church_id,'curehealthextended');
			
			// Restore health
			
			$hptorestore = CA_Curehealth_Model::get_hptorestore( $chartarget, $has_dogma_bonus);
				
			$chartarget -> modify_health ( $hptorestore , true );							
			$chartarget -> save();
			
			// Event notification for the cured char
			Character_Event_Model::addrecord
			( 
				$chartarget -> id, 
				'normal', 
				'__events.curefinishedoktarget'
			);
			// Event notification for the char who cures	
			Character_Event_Model::addrecord
			( 
				$charsource -> id, 
				'normal', 
				'__events.curefinishedoksource'.';'.$chartarget -> name
			);
			// Event notification by facility
			Structure_Event_Model::newadd
			( 
				$structure -> id, 
				'__events.curefinished;' . $chartarget -> name . ';__' . 'character.disease_' . $data -> param4
			);
		}
	}
	
	protected function execute_action() {}
	
	public function cancel_action() { 
			
		// find both actions
		
		$sourcecharaction = ORM::factory('character_action') -> 
			where ( 
				array(
					'action' => $this -> action,
					'character_id' => $this -> param1,
					'status' => 'running')
				) -> find();
		
		$targetcharaction = ORM::factory('character_action') -> 
			where ( 
				array(
					'action' => $this -> action,
					'character_id' => $this -> param2,
					'status' => 'running')
				) -> find();		
		
		$targetchar = ORM::factory('character', $this -> param2);		
		kohana::log('debug', '-> Target char is: ' . $targetchar -> name);
		
		$sourcechar = ORM::factory('character', $this -> param1);
		kohana::log('debug', '-> Source char is: ' . $sourcechar -> name);
		
		// The action cannot be canceled if the healing action is consequent
		// to a recovery
		
		if ( $this -> param4 == true )
			return false;
		
		// we cancel the other action. We can't call the method 
		// character_action -> cancel_pending_action otherwise it could 
		// fail the call with the source char_id.
		
		if ($this -> character_id == $targetchar -> id )
		{
			
			$sourcecharaction -> status = 'canceled' ;
			$sourcecharaction -> save();
			
			Character_Event_Model::addrecord
			( 
				$sourcechar -> id, 
				'normal', 
				'__events.curecanceled'.';'.$targetchar -> name
			);
			
			My_Cache_Model::delete(  '-charinfo_' . $sourcechar -> id . '_currentpendingaction' );
			
		}
		
		if ($this -> character_id == $sourcechar -> id )
		{
			$targetcharaction -> status = 'canceled' ;
			$targetcharaction -> save();
			Character_Event_Model::addrecord
			( 
				$targetchar -> id, 
				'normal', 
				'__events.curecanceled'.';'.$sourcechar -> name
			);
			My_Cache_Model::delete(  '-charinfo_' . $targetchar -> id . '_currentpendingaction' );
		}
				
		return true;
	}

	// This function constructs a message to be displayed 
	// waiting for the action to complete.
	
	public function get_action_message( $type = 'long') { }
	
	/*
	* Calculate elapsed time of the function (Overriden)
	* @param Character_Model $sourcecharacter character who cures
	* @param Character_Model $stargetcharacter character who is cured
	* @return int $time time in seconds
	*/
	
	public function get_action_time( $sourcecharacter, $targetcharacter )
	{
		
		// Calculate real time (applying attributes and bonuses etc.)
		$time = parent::get_action_time( $sourcecharacter );
		
		kohana::log('debug', '-> Applying Faithful Bonus...');
		
		kohana::log('debug', '-> Time now: '. Utility_Model::secs2hmstostring($time));
		
		return $time;
	}
	
	/*
	* Return how many HP should be restored
	* @param Character_Model $character character to take care of
	* @param bollean $has_dogma_bonus Flag which indicates whether the Church has
   *  the extended bonus
	* @return int $hp number of HP to be restored
	*/
	
	public function get_hptorestore( $character, $has_dogma_bonus )
	{
		
		$hptorestore = $character -> health;
		
		// In assenza del bonus esteso il recupero 
		// corrisponde al proprio FL

		if ( ! $has_dogma_bonus )
		{
			// Recupero la salute solo se il FL è
			// Maggiore della salute attuale del char
			$fl = Character_Model::get_stat_d( $character->id, 'faithlevel' );
			
			if ( $fl -> value > $character -> health )
				$hptorestore = $fl -> value ;			
		}			

		// In presenza del bonus:
		// L'ateo recupera il 100%, il fedele recupera il 100%
		// Se il proprio FL è > dell'80% altrimenti il proprio FL

		if ( $has_dogma_bonus )
		{
			// Il char curato è ateo
			
			if ( $character -> church -> name == 'nochurch' )			
				$hptorestore = 100 ;					
			else
			{
				// Il char curato è un fedele
				$fl = Character_Model::get_stat_d( $character -> id, 'faithlevel' );
				
				kohana::log('debug', 'Faith Level of cured: ' . $fl -> value );
				
				// Se ha ul FL >= 75 recupera il 100%
				if ( $fl -> value >= 75 )
					$hptorestore = 100 ;
				
				// Altrimenti recupera il proprio FL, ammesso che
				// sia più alto del suo livello di salute
				
				elseif ( $fl -> value > $character -> health )				
					$hptorestore = $fl -> value ;					
				
			}
		}
		
		return $hptorestore;
		
	}
	
}
