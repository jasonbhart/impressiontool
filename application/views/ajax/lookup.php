<?php $index = $_POST['currentResult']; ?>
<?php foreach ($resultWhois as $whois): ?>
	<?php if ($whois['whois_status'] == -1) $class = 'notwhois'; ?>
	<?php if ($whois['whois_status'] == 1) $class = 'black'; ?>
	<?php if ($whois['whois_status'] == 0) $class = 'white'; ?>
	<tr class="<?php echo $class; ?> tr_<?php echo $index; ?>"> 
		<td><?php echo ($index + 1); ?></td>
		<td><?php echo $whois['ip']; ?></td>
		<td onclick="setDataToEditBlockName(this, '<?php echo $whois['ip_block_name']; ?>')" data-toggle="modal" data-target="#addToListBlockName"><?php echo $whois['ip_block_name']; ?></td>
		<td onclick="setDataToEditBlockRange(this, '<?php echo $whois['ip_block_range']; ?>')" data-toggle="modal" data-target="#addToListBlockRange"><?php echo $whois['ip_block_range']; ?></td>
		<td onclick="setDataToEditBlockOwner(this, '<?php echo $whois['ip_block_owner']; ?>')" data-toggle="modal" data-target="#addToListBlockOwner"><?php echo $whois['ip_block_owner']; ?></td>
	</tr>
	<?php $index++; ?>
<?php endforeach; ?>
							