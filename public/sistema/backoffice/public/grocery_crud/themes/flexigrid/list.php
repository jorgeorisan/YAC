<?php 
	$column_width = (int)(80/count($columns));
	
	if(!empty($list)){
?><div class="bDiv" >
		<table cellspacing="0" cellpadding="0" border="0" style="" id="flex1" width='960'>
		<thead>
			<tr class='hDiv'>
				<?php foreach($columns as $column){?>
				<th width='<?=$column_width?>%'>
					<div class="text-left field-sorting <?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?><?=$order_by[1]?><?php }?>" 
						rel='<?=$column->field_name?>'>
						<?=$column->display_as?>
					</div>
				</th>
				<?php }?>
				<th align="left" abbr="tools" axis="col1" class="" width='20%'>
					<div class="text-right">
						Tools
					</div>
				</th>
			</tr>
		</thead>		
		<tbody>
<?php foreach($list as $num_row => $row){ ?>        
		<tr  <?php if($num_row % 2 == 1){?>class="erow"<?php }?>>
			<?php foreach($columns as $column){?>
			<td width='<?=$column_width?>%' class='<?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?>sorted<?php }?>'>
				<div style="width: 100%;" class='text-left'>
					<?=!empty($row->{$column->field_name}) ? $row->{$column->field_name} : '&nbsp;'?>
				</div>
			</td>
			<?php }?>
			<td align="left" width='20%'>
				<div class='tools'>
					<?php if(!$unset_delete){?>
                    	<a href='<?=$row->delete_url?>' title='Delete <?=$subject?>'  class='delete-row' ><div class='delete-icon'></div></a>
                    <?php }?>
                    <?php if(!$unset_edit){?>
						<a href='<?=$row->edit_url?>' title='Edit <?=$subject?>'><div class='edit-icon'></div></a>
					<?php }?>
                    <div class='clear'></div>
				</div>
			</td>
		</tr>
<?php } ?>        
		</tbody>
		</table>
	</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; No items to display
	<br/>
	<br/>
<?php }?>	