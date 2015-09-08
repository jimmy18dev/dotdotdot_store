<tr>
	<td><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_id'];?></a></td>
	<td><?php echo $var['pd_title'];?></td>
	<td><?php echo $var['pd_description'];?></td>
	<td><?php echo $var['pd_unit'];?></td>
	<td><?php echo $var['pd_price'];?></td>
	<td><?php echo $var['pd_create_time'];?></td>
	<td><?php echo $var['pd_update_time'];?></td>
	<td><img src="store/<?php echo $var['im_thumbnail'];?>" alt="" width="80"></td>
	<td><?php if($var['pd_type'] != 'root' && $var['pd_unit'] > 0){?><button onclick="javascript:AddItemToOrder(<?php echo $var['pd_id'];?>);">ซื้อเลย</button><?php }?></td>
</tr>