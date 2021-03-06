<?php echo html::script('media/js/jquery/plugins/markitup/jquery.markitup.js', FALSE)?>
<?php echo html::script('media/js/jquery/plugins/markitup/sets/bbcode/set.js', FALSE)?>
<script>

$(document).ready(function()
{	
	$('#law_desc').markItUp(mySettings);
   
	$("#showpreview").click(function() 
		{				
			$.ajax( //ajax request starting
			{
			url: "index.php/jqcallback/bbcodepreview", 
			type:"POST",
			data: { text: $("#law_desc").val() },
			success: 
				function(data) 
				{																	
					$("#preview").html(data); 				
				}
			}	
			);						
	});
});
</script>

<div class="pagetitle"><?php echo kohana::lang('structures_castle.editlaw_pagetitle'); ?></div>

<?php echo $submenu ?>

<?php echo html::image(array('src' => 'media/images/template/hruler.png')); ?>

<br/><br/>

<div class='submenu'>
<?php echo html::anchor('royalpalace/viewlaws/'.$structure->id, kohana::lang('structures_castle.viewlaws'))?>
</div>

<br/>

<?php echo form::open() ?>
<?php echo form::hidden('structure_id', $structure->id) ?>
<?php echo form::hidden('law_id', $law->id) ?>

<div><?php echo form::label('law_name', kohana::lang('global.title')) ?></div>
<div>
<?php 
	echo form::input( array( 
			'id' => 'law_name', 
			'name' => 'law_name', 
			'value' => $form['law_name'],
			'class' => 'input-xlarge',
		) 
	);
	if (!empty ($errors['law_name'])) 
		echo "<div class='error_msg'>".$errors['law_name']."</div>";
?>
</div>

<br/>
<div><?php echo form::label('law_desc', kohana::lang('global.description')) ?></div>
<div><?php echo form::textarea(array( 'id' => 'law_desc', 'name' => 'law_desc', 'rows' => 10, 'cols' => 120), empty( $form['law_desc']) ? '' : 	$form['law_desc'] )?></div>
<?php if (!empty ($errors['law_desc'])) echo "<div class='error_msg'>".$errors['law_desc']."</div>";?>


<br/>
<div class='center'>
<?php
		echo form::submit( array (
			'id' => 'showpreview', 
			'class' => 'button button-small', 			
			'onclick' => 'return false' ),
			kohana::lang('global.preview')); 
		?>
		&nbsp;
		<?php 
		echo form::submit( array (
			'id' => 'submit', 
			'class' => 'button button-small', 
			'name' => 'add', 
			'onclick' => 'return confirm(\''.kohana::lang('global.confirm_operation').'\')' ), kohana::lang('global.edit'))
		?>
</div>

<?php echo form::close() ?>

<br/>

<?php echo html::image(array('src' => 'media/images/template/hruler.png')); ?>

<br/><br/>

<h5>Preview</h5>
<div id="preview"></div>

<br style='clear:both'/>
