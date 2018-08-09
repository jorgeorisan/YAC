<?php 
	$this->load->css('public/grocery_crud/themes/flexigrid/css/flexigrid.css');
	$this->load->js('public/grocery_crud/themes/flexigrid/js/jquery.form.js');	
	$this->load->js('public/grocery_crud/themes/flexigrid/js/flexigrid-add.js');
?>
<div class="flexigrid" style='width: 100%;'>	
	<div class="mDiv">
		<div class="ftitle">
			<div class='ftitle-left'>
				Add <?=$subject?>
			</div>
			<div class='ftitle-right'>
				<a href='<?=$list_url?>' onclick='javascript: return goToList()' >Back to list</a>
			</div>
			<div class='clear'></div>
		</div>
		<div title="Minimize/Maximize Table" class="ptogtitle">
			<span></span>
		</div>
	</div>
<div id='main-table-box'>
	<form action='<?=$insert_url?>' method='post' id='crudForm' autocomplete='off' enctype="multipart/form-data">
		<div class='form-div'>
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
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>							
		</div>	
		<div class="pDiv">
			<div class='form-button-box'>
				<input type='submit' value='Save'/>
			</div>			
			<div class='form-button-box'>
				<input type='button' value='Cancel' onclick="javascript: goToList()" />
			</div>
			<div class='form-button-box'>
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