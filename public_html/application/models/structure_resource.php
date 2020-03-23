<?php defined('SYSPATH') OR die('No direct access allowed.');

class Structure_Resource_Model extends ORM
{
	protected $belongs_to = array('structure' ); 

	/**
	* edit resources
	*/
	
	public function modify_quantity( $delta )
	{
		$this -> current += $delta;
		if ( $this -> current < 0 )
			$this -> current = 0;
		$this -> save();	
	}
	
	/*
	* Go back to the resource level
	* @param in $structure_id ID Structure
	* @return int level %o false if there is no resource
	*/
	
	static function get_resourcelevel( $structure_id )
	{
		
		$rset = Database::instance() -> query(
			"SELECT distinct r.id, r.name reegion_name, st.type, st.name structure_name, sr.current, sr.max 
			 FROM structure_resources sr, structures s, regions r, structure_types st
			 WHERE sr.structure_id = s.id
			 AND   s.region_id = r.id 
			 AND   s.id = {$structure_id} 
			 AND   s.structure_type_id = st.id");
		
		if ( count($rset) > 0 )
			return round( ($rset -> current() -> current / $rset -> current() -> max) * 100, 0 );
		else
			return false;
		
	}
	
	/*
	* Return the resources of each region
	* @param none
	* @return obj $rset ResultSet
	*/
	
	static function get_resources()
	{
		
		$rset = Database::instance() -> query(
			"SELECT distinct r.id, r.name region_name, st.type, st.name structure_name, sr.current, sr.max 
			 FROM structure_resources sr, structures s, regions r, structure_types st
			 WHERE sr.structure_id = s.id
			 AND   s.region_id = r.id 
			 AND   s.structure_type_id = st.id");
		
		return $rset;
		
	}
	
}
