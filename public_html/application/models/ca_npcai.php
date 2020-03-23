<?php defined('SYSPATH') OR die('No direct access allowed.');

class CA_NPCAI_Model extends Character_Action_Model
{
	
	const CYCLE_TIME = 28800; // Cycle time in seconds (8 hours)
	
	protected $cancel_flag = false;
	protected $immediate_action = true;	
	protected $attribute      = null;
	protected $appliedbonuses = null;	
	protected $requiresequipment = false;
	protected $enabledifrestrained = true;		
	
	public function __construct()
	{		
		
		parent::__construct();
		
		$this -> blocking_flag = false;
		$this -> cycle_flag = true;		
		$this -> starttime = time();
		$this -> endtime = time();
		return $this;
	}
	
	protected function check( $par, &$error )
	{ 		
		return true;
	}
	
	protected function append_action() {}

	public function complete_action( $data )
	{
		
		$char = ORM::factory('character', $data -> character_id);
		
		// Call NPC AI only if the NPC is alive
		
		if ( is_null($char -> status) )
		{
			// call the AI function
			
			kohana::log('debug', "-> Calling AI function for char: {$char -> name}	");
			$npcobj = ORM::factory('character_npc_' . $char -> npctag ) 
				-> find( $char -> id );
			kohana::log('debug', "-> Calling AI function for char: {$char -> name}	");
			
			$npcobj -> npcai();
			
			kohana::log('debug', "-> Extablishing new cycle for npcai...");
					
		}		
		
		// Set the time for a new cycle
			
		$a = ORM::factory('character_action', $data -> id );
		$a -> starttime = time() + self::CYCLE_TIME + (rand(1,2)*3600);
		$a -> endtime = $a -> starttime;
		$a -> save();
		
	}
	

	// This function constructs a message to be displayed 
	// waiting for the action to be completed.
	public function get_action_message( $type = 'long') 
	{		
		return ;
	}
	
}
