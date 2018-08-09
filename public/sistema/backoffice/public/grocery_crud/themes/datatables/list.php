<table cellpadding="0" cellspacing="0" border="0" class="display" id="groceryCrudTable">
	<thead>
		<tr>
			<?php foreach($columns as $column){?>
				<th><?=$column->display_as?></th>
			<?php }?>
			<th align='right'>Tools</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($list as $num_row => $row){ ?>  
		<tr id='row-<?=$num_row?>'>
			<?php foreach($columns as $column){?>
				<td><?=$row->{$column->field_name}?></td>
			<?php }?>
			<td align='right' width='200'>
				<?php if(!$unset_edit){?>
					<a href="<?=$row->edit_url?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span class="ui-button-text">Edit</span></a>
				<?php }?>
				<?php if(!$unset_delete){?>
					<a onclick = "javascript: return delete_row('<?=$row->delete_url?>', '<?=$num_row?>')" 
						href="javascript:void(0)" class="delete_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-circle-minus"></span>
						<span class="ui-button-text">Delete</span>
					</a>
				<?php }?>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>