<?php if(!empty($notice)) {?> <h3><?=$notice;?></h3> <?php } ?>
<h4><?=$this->html->link('Index', $contrl.'/index');?> | <?=$this->html->link('Add', $contrl.'/add');?></h4>

<?php if(empty($data)) { ?>
	<h3>There is no data, please put some in there!</h3>
<?php } else { ?>
	<table>
		<thead>
			<tr>
				<?php // foreach(current($data) as $key => $val) echo "<th>$key</th>"; ?>
				<?php foreach($keys as $key) echo "<th>$key</th>"; ?>
				<th>Modify</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $id => $row) { ?>
			<tr>
				<?php foreach($keys as $key) { if(array_key_exists($key, $row)) echo "<td>".$row[$key]."</td>"; else echo '<td></td>'; }?>
				<td>
					<?=$this->html->link('Edit', $contrl.'/edit/'.$id);?> |
					<?=$this->html->link('Delete', $contrl.'/delete/'.$id);?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>