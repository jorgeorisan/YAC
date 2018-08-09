<?php 
	$this->load->css('public/grocery_crud/themes/datatables/css/demo_table_jui.css');
	$this->load->css('public/grocery_crud/themes/datatables/css/ui/simple/jquery-ui-1.8.10.custom.css');
	$this->load->css('public/grocery_crud/themes/datatables/css/datatables.css');	
	$this->load->js('public/grocery_crud/themes/datatables/js/jquery-1.5.1.min.js');
	$this->load->js('public/grocery_crud/themes/datatables/js/jquery-ui-1.8.10.custom.min.js');
	$this->load->js('public/grocery_crud/themes/datatables/js/jquery.dataTables.min.js');
	$this->load->js('public/grocery_crud/themes/datatables/js/datatables.js');
?>
<script>
	var subject = '<?=$subject?>';
</script>
<div id='report-error' class='report-div error report-list'></div>
<div id='report-success' class='report-div success report-list'></div>	
<?php if(!$unset_add){?>
<a role="button" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" href="<?=$add_url?>">
	<span class="ui-button-icon-primary ui-icon ui-icon-circle-plus"></span>
	<span class="ui-button-text">Add <?=$subject?></span>
</a>
<?php }?>
<div style='height:10px;'></div>
<?=$list_view?>