<?php defined('SYSPATH') OR die('No direct access allowed.');

class CA_Finishwar_Model extends Character_Action_Model
{
	
	protected $immediate_action = true;
	protected $war = null;
	
	// Perform all the controls related to the action, both those shared
	// with all the actions that peculiar ones 
	// @input: array of parameters
	// par[0]: char object
	// par[1]: id war
	// @output: TRUE = action available, FALSE = action not available
	//          $message contains the return message	
	
	protected function check( $par, &$message )
	{ 	
		
		$allwars = Configuration_Model::get_kingdomswars();
		
		// war must exist and in progress
		if (!isset($allwars[$par[1]]) or $allwars[$par[1]]['war'] -> status != 'running')
		{
			$message = kohana::lang( 'ca_finishwar.error-warnotfound');
			return false;
		}						
		// only those who launched the war can end the war
		$sourcekingdom = ORM::factory('kingdom', $allwars[$par[1]]['war'] -> source_kingdom_id);
		$sourceking = $sourcekingdom -> get_king();
		if (is_null($sourceking) or $sourceking -> id != $par[0] -> id )
		{
			$message = kohana::lang( 'ca_finishwar.error-youdidnotdeclarewar');
			return false;
			
		}
		
		$this -> war = $allwars[$par[1]];
		
		return true;				
	}
		
	protected function append_action( $par, &$message ) {}

	function complete_action( $data ) {}
	
	public function execute_action ( $par, &$message) 
	{
		$war = ORM::factory('kingdom_war', $this -> war['war'] -> id);
		$war -> finish( 'terminatedbysourceking' );
		
		$message = kohana::lang( 'ca_finishwar.info-youhaveterminatedwar');

		return true;

	}
}
