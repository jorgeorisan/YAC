<?php 
	$this->load->css('public/grocery_crud/themes/datatables/css/datatables.css');
	$this->load->js('public/grocery_crud/themes/flexigrid/js/jquery.form.js');	
	$this->load->js('public/grocery_crud/themes/datatables/js/datatables-add.js');
	$this->load->css('public/grocery_crud/css/ui/simple/jquery-ui-1.8.10.custom.css');
	$this->load->js('public/grocery_crud/js/jquery_plugins/jquery-ui-1.8.10.custom.min.js');	
?>

<div class='ui-widget-content ui-corner-all datatables'>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-default form-title">
		<div class='floatL form-title-left'>
			<a href="#">Add <?=$subject?></a>
		</div> 
		<div class='floatR'>
			<a href='<?=$list_url?>' onclick='javascript: return goToList()' class='gotoListButton' >
				Back to list
			</a>
		</div>
		<div class='clear'></div>
	</h3>
<div class='form-content form-div'>
	<form action='<?=$insert_url?>' method='post' id='crudForm' autocomplete='off' enctype="multipart/form-data">
		<div>
			<?php
			$counter = 0; 
				foreach($fields as $field)
				{
					$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
					$counter++;
			?>
			<div class='form-field-box <?=$even_odd?>'>
				<div class='form-display-as-box'>
					<?=$input_fields[$field->field_name]->display_as?><?=($input_fields[$field->field_name]->required)? "* " : ""?> :
				</div>
				<div class='form-input-box'>
					<?=$input_fields[$field->field_name]->input?>
				</div>
				<div class='clear'></div>	
			</div>
			<?php }?>
			<div class='line-1px'></div>
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>							
		</div>	
		<div class='buttons-box'>
			<div class='form-button-box'>
				<input type='submit' value='Save' class='ui-input-button'/>
			</div>			
			<div class='form-button-box'>
				<input type='button' value='Cancel' onclick="javascript: goToList()" class='ui-input-button' />
			</div>
			<div class='form-button-box loading-box'>
				<div class='small-loading' id='FormLoading'>Loading...</div>
			</div>
			<div class='clear'></div>	
		</div>
	</form>	
</div>
</div>
<script>
	var validation_url = '<?=$validation_url?>';
	var list_url = '<?=$list_url?>';
</script>