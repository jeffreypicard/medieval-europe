<head>
<script>

$(document).ready(function()
{		
$("#regions").autocomplete({
		source: "index.php/jqcallback/listallregions",
		minLength: 2
	});	
});
</script>
</head>

<div class="pagetitle"><?php echo kohana::lang('admin.manage_npcs')?></div>

<?php echo $submenu ?>

<div id='helper'>
Manage NPC characters by adding to deleting them from different areas
</div>
<?php echo form::open('/admin/manage_npcs'); ?>
<?php echo form::hidden('regions', $form['regions']) ?>

<br/>
NPC <?php echo form::dropdown('npc', $npcs);?>
<br/>
Quantity <?php	echo form::input( array( 'id'=>'quantity', 'name' => 'quantity', 'value' =>  $form['quantity'], 'style'=>'width:40px;text-align:right') ); ?>
<br/>

Region <?php	echo form::input( array( 'id'=>'regions', 'name' => 'regions', 'value' =>  $form['regions'], 'style'=>'width:300px') ); ?>
<br/><br/>

<center>
<?php echo form::submit( 
	array( 
	'id' => 'submit', 
	'class' => 'button button-medium', 
	'onclick' => 
	'return confirm(\''.kohana::lang('global.confirm_operation').'\')', 'value' => Kohana::lang('global.edit_submit')));?>
</center>
<?php echo form::close() ?>

<br style="clear:both;" />
