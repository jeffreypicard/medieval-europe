<?php defined('SYSPATH') OR die('No direct access allowed.');

class ST_Terrain_2_Model extends ST_Terrain_1_Model
{
	public function init()
	{
		parent::init();
		$this -> setCurrentLevel(2);
	}

}
