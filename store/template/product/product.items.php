<tr>
	<td><a href="product_detail.php?id=<?php echo $var['pd_id'];?>" target="_parent"><?php echo $var['pd_id'];?></a></td>
	<td><?php echo ($var['pd_type'] == "root"?'Root':$var['pd_parent']);?></td>
	<td><?php echo $var['pd_code'];?></td>
	<td><?php echo $var['pd_title'];?></td>
	<td><?php echo $var['pd_description'];?></td>
	<td><?php echo $var['pd_unit'];?></td>
	<td><?php echo $var['pd_price'];?></td>
	<td><?php echo $var['pd_create_time'];?></td>
	<td><?php echo $var['pd_update_time'];?></td>
	<td><img src="image/upload/thumbnail/<?php echo $var['im_filename'];?>" alt="" width="80"></td>
	<td><?php if($var['pd_parent'] == 0){?><a href="product_editor.php?parent=<?php echo $var['pd_id'];?>">เพิ่มสินค้า</a><?php }?></td>
</tr>