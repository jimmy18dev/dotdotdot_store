<tr>
	<td><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_id'];?></a></td>
	<td><?php echo $var['pd_title'];?></td>
	<td><?php echo $var['pd_description'];?></td>
	<td><?php echo $var['pd_size_d'];?></td>
	<td><?php echo $var['pd_size_ss'];?></td>
	<td><?php echo $var['pd_size_s'];?></td>
	<td><?php echo $var['pd_size_m'];?></td>
	<td><?php echo $var['pd_size_l'];?></td>
	<td><?php echo $var['pd_size_xl'];?></td>
	<td><?php echo $var['pd_price'];?></td>
	<td><?php echo $var['pd_create_time'];?></td>
	<td><?php echo $var['pd_update_time'];?></td>
	<td><img src="<?php echo $var['im_thumbnail'];?>" alt="" width="80"></td>
	<td><button onclick="javascript:AddItemToOrder(<?php echo $var['pd_id'];?>);">ซื้อเลย</button></td>
</tr>