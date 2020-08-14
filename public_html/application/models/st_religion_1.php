<?php defined('SYSPATH') OR die('No direct access allowed.');

class ST_Religion_1_Model extends Structure_Model
{
	public function init()
	{	
		$this -> setCurrentLevel(1);
		$this -> setParenttype('religion_1');
		$this -> setSupertype('religion_1');
		$this -> setMaxlevel(1);
		$this -> setIsbuyable(false);
		$this -> setIssellable(false);	
		$this -> setStorage(10000000);	
		$this -> setWikilink('En_US_Religious_Structure_level_1');		
	}
	

	// Function that builds the common links related to the structure
	// @output: content string i links relative to that structure
	public function build_common_links( $structure, $bonus = false )
	{
		
		$links = parent::build_common_links( $structure );
		
		
		// Common actions accessible to all chars
		$links .= html::anchor( "/structure/info/" . $structure -> id, Kohana::lang('structures_actions.global_info'), array('class' => 'st_common_command')) . "<br/>";
		
		$links .= html::anchor( "/structure/donate/" . $structure -> id, Kohana::lang('structures_actions.global_deposit'), array('class' => 'st_common_command')) . "<br/>";	
		
		$links .= html::anchor( "/structure/pray/" . $structure -> id, Kohana::lang('religion.pray'), array('class' => 'st_common_command')) ;		
		
		if ( $bonus !== false )
		{
		   	$links .= ' - '.html::anchor( "/structure/pray/".$structure->id."/2", 'x2',
		    array('title' => Kohana::lang('religion.pray').' (x2)', 'class' => 'st_common_command',
					'onclick' => 'return confirm(\''.kohana::lang('global.confirm_operation').'\')' ));
		    
		   	$links .= ' - '.html::anchor( "/structure/pray/".$structure->id."/3", 'x3',
		    array('title' => Kohana::lang('religion.pray').' (x3)', 'class' => 'st_common_command',
					'onclick' => 'return confirm(\''.kohana::lang('global.confirm_operation').'\')' ));
		}		
		
		$links .= '<br/><br/>';
			
		return $links;
	}

	// Function that builds the special links related to the structure
	// @output: content string i links relative to that structure
	public function build_special_links( $structure, $bonus = false)
	{
		
		
		// Special actions accessible only to the char that governs the structure
		$links = parent::build_special_links( $structure );

		$links .= html::anchor( "/structure/rest/" . $structure -> id, Kohana::lang('structures_actions.rest'),
			array('title' => Kohana::lang('structures_actions.rest'), 'class' => 'st_special_command')). "<br/>";
			
		return $links;
	}
}
