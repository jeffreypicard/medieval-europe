<?php defined('SYSPATH') OR die('No direct access allowed.');

class Structure_Event_Model extends ORM
{
  protected $sorting = array('id' => 'desc');

	/**
	* Function that adds an announcement or event to the structure
	* @param structure_id id structure	
	* @param text Text of the announcement
	* class CSS class of the announcement. For now, only evidence exists
	*/
	
	public function add_model($structure_id, $text, $eventclass = null )
	{
		$this->id=null;
		$this->structure_id = $structure_id;
		$this->type = 'normal';
		$this->description = $text;
		$this->timestamp = time();		
		$this->eventclass = $eventclass;
		$this->save();		
		
	}
	
	/**
	* function that adds an announcement or event to the structure
	* @param structure_id id structure	
	* @param text Text of the announcement
	* class CSS class of the announcement. For now, only evidence exists
	*/
	
	public function newadd( $structure_id, $text, $eventclass = null )
	{
		$a = new Structure_Event_Model();	
		$a -> id = null;
		$a -> structure_id = $structure_id;
		$a -> type = 'normal';
		$a -> description = $text;
		$a -> timestamp = time();		
		$a -> eventclass = $eventclass;
		$a -> save();		
		
	}

}
