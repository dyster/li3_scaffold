<pre><?php print_r($data); ?></pre>
<?=$this->html->link('Add', $contrl.'/add');?>
<table>
	<thead>
		<tr>
			<?php foreach(current($data) as $key => $val) echo "<th>$key</th>"; ?>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $id => $row) { ?>
		<tr>
			<?php foreach($row as $val) echo "<td>$val</td>"; ?>
			<td>
				<?=$this->html->link('Edit', $contrl.'/edit/'.$id);?> |
				<?=$this->html->link('Delete', $contrl.'/delete/'.$id);?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
