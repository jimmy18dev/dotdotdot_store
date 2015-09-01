<tr>
	<td><a href="order_detail.php?id=<?php echo $var['od_id'];?>"><?php echo $var['od_id'];?></a></td>
	<td><?php echo $var['me_name'];?></td>
	<td><?php echo $var['od_total'];?></td>
	<td><?php echo $var['od_amount'];?></td>
	<td><?php echo $var['od_payments'];?></td>
	<td><?php echo $var['od_payments']+50;?></td>
	<td>Shipping</td>
	<td><?php echo $var['od_status'];?></td>
	<td><?php echo $var['od_update_time'];?></td>
	<td><?php echo $var['od_create_time'];?></td>
</tr>