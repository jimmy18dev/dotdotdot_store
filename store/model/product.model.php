<?php
class ProductModel extends Database{

	public function CreateProductProcess($param){
		parent::query('INSERT INTO dd_product(pd_parent,pd_code,pd_title,pd_description,pd_price,pd_create_time,pd_update_time,pd_visit_time,pd_order_time,pd_group,pd_type,pd_status) VALUE(:parent,:code,:title,:description,:price,:create_time,:update_time,:visit_time,:order_time,:group,:type,:status)');

		parent::bind(':parent', 		$param['parent']);
		parent::bind(':code', 			$param['code']);
		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':visit_time',		date('Y-m-d H:i:s'));
		parent::bind(':order_time',		date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function EditProductProcess($param){
		parent::query('UPDATE dd_product SET pd_code = :code, pd_title = :title, pd_description = :description, pd_price = :price, pd_update_time = :update_time, pd_group = :group, pd_status = :status WHERE pd_id = :product_id');

		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':code', 			$param['code']);
		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':status',			$param['status']);
		parent::execute();
	}

	public function UpdateRootProductProcess($param){
		parent::query('UPDATE dd_product SET pd_type = "root" WHERE pd_id = :product_id');
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}

	// Product Position Sorting
	// Set Product sort position
	public function PositionSetupProcess($param){
		parent::query('UPDATE dd_product SET pd_sort = :position WHERE pd_id = :product_id');
		parent::bind(':position', 		$param['position']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}

	public function PositionChangeProcess($param){
		// Get current position and type
		parent::query('SELECT pd_parent,pd_sort,pd_type FROM dd_product WHERE pd_id = :product_id');
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
		$data = parent::single();

		$current_position 	= $data['pd_sort'];
		$parent 			= $data['pd_parent'];
		$type 				= $data['pd_type'];

		if($current_position != 1){
			if($type == "root" || $type == "normal"){
				// Prev product
				parent::query('SELECT pd_id,pd_sort FROM dd_product WHERE (pd_sort < :current_position) AND (pd_type = "normal" OR pd_type = "root") ORDER BY pd_sort DESC LIMIT 1');
				parent::bind(':current_position', $current_position);
				parent::execute();
				$data = parent::single();

				$prev_id 		= $data['pd_id'];
				$prev_position 	= $data['pd_sort'];
			}

			else if($type == "sub"){
				// Prev product
				parent::query('SELECT pd_id,pd_sort FROM dd_product WHERE (pd_sort < :current_position AND pd_parent = :parent) AND (pd_type = "sub") ORDER BY pd_sort DESC LIMIT 1');
				parent::bind(':parent', $parent);
				parent::bind(':current_position', $current_position);
				parent::execute();
				$data = parent::single();

				$prev_id		= $data['pd_id'];
				$prev_position 	= $data['pd_sort'];
			}
			else{
				return false;
			}


			// Update Current position to Prev product.
			parent::query('UPDATE dd_product SET pd_sort = :position WHERE pd_id = :product_id');
			parent::bind(':position', 		$current_position);
			parent::bind(':product_id', 	$prev_id);
			parent::execute();

			// Update Prev position to Current position (New Position)
			parent::query('UPDATE dd_product SET pd_sort = :position WHERE pd_id = :product_id');
			parent::bind(':position', 		$prev_position);
			parent::bind(':product_id', 	$param['product_id']);
			parent::execute();
		}
		else{
			return false;
		}
	}	

	public function CountProcess($param){
		if($param['type'] == "sub"){
			parent::query('SELECT COUNT(pd_id) FROM dd_product WHERE (pd_type = "sub" AND pd_parent = :parent_id)');
			parent::bind(':parent_id', 	$param['parent_id']);
			parent::execute();
			$data = parent::single();
		}
		else if($param['type'] == "normal"){
			parent::query('SELECT COUNT(pd_id) FROM dd_product WHERE pd_type = "normal" OR pd_type = "root"');
			parent::execute();
			$data = parent::single();
		}
		else{

			// Count all product
			parent::query('SELECT COUNT(pd_id) FROM dd_product');
			parent::execute();
			$data = parent::single();
		}

		return $data['COUNT(pd_id)'];
	}


	// public function DeleteProductProcess($param){
	// 	parent::query('DELETE FROM dd_product WHERE pd_id = :product_id');
	// 	parent::bind(':product_id', 	$param['product_id']);
	// 	parent::execute();
	// }


	// Get and List
	public function GetProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_view,pd_read,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_id,im_filename,im_format,(SELECT COUNT(odt_amount) FROM dd_order_detail LEFT JOIN dd_order ON od_id = odt_order_id WHERE odt_product_id = 2) total_in_order FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id AND im_type = "cover" WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		return parent::single();
	}

	public function ListPhotoProductProcess($param){
		parent::query('SELECT * FROM dd_image WHERE im_product_id = :product_id AND im_status = "active" AND im_type = "normal" ORDER BY im_type,im_create_time');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_sort,pd_status,im_id,im_filename FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id AND im_type = "cover" WHERE pd_type != "sub" ORDER BY pd_sort ASC');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListSubProductProcess($param){
		parent::query('SELECT * FROM dd_product WHERE pd_parent = :product_id AND pd_type = "sub" ORDER BY pd_sort ASC');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	// Photo cover module
	public function CoverAlreadyProcess($param){
		parent::query('SELECT im_id FROM dd_image WHERE im_product_id = :product_id AND im_type = "cover"');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$data = parent::single();

		if(empty($data['im_id']))
			return true;
		else
			return false;
	}

	public function AutosetCover($param){
		parent::query('UPDATE dd_image SET im_type = "cover" WHERE im_product_id = :product_id ORDER BY im_create_time DESC LIMIT 1');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
	}

	public function SetCoverProcess($param){
		// Clear all cover
		parent::query('UPDATE dd_image SET im_type = "normal" WHERE im_product_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();

		// Set cover
		parent::query('UPDATE dd_image SET im_type = "cover" WHERE im_product_id = :product_id AND im_id = :image_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':image_id', $param['image_id']);
		parent::execute();
	}

	public function DeletePhotoProcess($param){
		parent::query('UPDATE dd_image SET im_status = "disable" WHERE (im_product_id = :product_id AND im_id = :image_id)');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':image_id', $param['image_id']);
		parent::execute();
	}

	// Change product status (active, disable)
	public function ChangeStatusProcess($param){
		parent::query('UPDATE dd_product SET pd_status = :status, pd_update_time = :update_time WHERE (pd_id = :product_id)');
		parent::bind(':status', 		$param['status']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}


	// Product quantity
	public function UpdateQuantityProcess($param){
		// Clear all cover
		parent::query('UPDATE dd_product SET pd_quantity = :quantity, pd_update_time = :update_time WHERE pd_id = :product_id');
		parent::bind(':quantity', 		$param['quantity']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}

	// Product Activity
	public function CreateProductActivityProcess($param){
		parent::query('INSERT INTO dd_product_activity(pdac_token,pdac_admin_id,pdac_product_id,pdac_action,pdac_value,pdac_description,pdac_ref_id,pdac_ip,pdac_time) VALUE(:token,:admin_id,:product_id,:action,:value,:description,:ref_id,:ip,:time)');

		parent::bind(':token', 			$param['token']);
		parent::bind(':admin_id', 		$param['admin_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':action', 		$param['action']);
		parent::bind(':value', 			$param['value']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':ref_id', 		$param['ref_id']);
		parent::bind(':ip',				parent::GetIpAddress());
		parent::bind(':time',			date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}

	// Product Import/Export History
	// public function HistoryProductProcess($param){
	// 	parent::query('SELECT pdac_id,pdac_action,pdac_value,pdac_description,pdac_time,me_id,me_name FROM dd_product_activity LEFT JOIN dd_member ON pdac_admin_id = me_id WHERE pdac_product_id = :product_id ORDER BY pdac_time DESC');
	// 	parent::bind(':product_id', $param['product_id']);
	// 	parent::execute();
	// 	$dataset = parent::resultset();

	// 	foreach ($dataset as $k => $var) {
	// 		$dataset[$k]['create_time_thai_format'] = parent::date_thaiformat($var['pdac_time']);
	// 	}

	// 	return $dataset;
	// }

	public function HistoryProductProcess($param){
		parent::query('SELECT pdac_id,admin.me_id admin_id,admin.me_name admin_name,pdac_action,pdac_value,od_id,customer.me_id  customer_id,customer.me_name customer_name,od_status FROM dd_product_activity LEFT JOIN dd_order_detail ON pdac_ref_id = odt_id LEFT JOIN dd_order ON odt_order_id = od_id LEFT JOIN dd_member AS customer ON od_member_id = customer.me_id LEFT JOIN dd_member AS admin ON pdac_admin_id = admin.me_id WHERE pdac_product_id = :product_id AND (pdac_action = "import" OR pdac_action = "export" OR pdac_action = "SoldOut") ORDER BY pdac_time ASC');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['create_time_thai_format'] = parent::date_thaiformat($var['pdac_time']);
		}

		return $dataset;
	}
}
?>