<?php
class ProductController extends ProductModel{
	public $id;
	public $title;
	public $description;
	public $price;
	public $create_time;
	public $update_time;
	public $visit_time;
	public $order_time;
	public $quantity;
	public $view;
	public $read;
	public $group;
	public $type;
	public $status;

	// Already in Order
	public $in_order;

	// Image of product
	public $image_id;
	public $image_filename;
	public $image_format;

	public function GetProduct($param){
        $data = parent::GetProductProcess($param);

        $this->id = $data['pd_id'];
        $this->title = $data['pd_title'];
        $this->description = $data['pd_description'];
        $this->quantity = $data['pd_quantity'];
        $this->price = $data['pd_price'];
        $this->create_time = $data['pd_create_time'];
        $this->update_time = $data['pd_update_time'];
        $this->view = $data['pd_view'];
        $this->read = $data['pd_read'];
        $this->group = $data['pd_group'];
        $this->type = $data['pd_type'];
        $this->status = $data['pd_status'];

        $this->in_order = $data['odt_id'];

        $this->image_id = $data['im_id'];
        $this->image_filename = $data['im_filename'];
        $this->image_format = $data['im_format'];

    }

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->RenderProduct('product','',$dataset);
	}

	public function ListSubProduct($param){
		$dataset = parent::ListSubProductProcess($param);
		$this->RenderProduct('subproduct','',$dataset);
	}

	public function ListSubPhoto($param){
		$dataset = parent::ListSubPhotoProcess($param);
		$this->RenderProduct('subphoto',$param['page_title'],$dataset);
	}

	public function CreateProduct($param){
		return parent::CreateProductProcess($param);
	}

	public function UpdateView($param){
		$param['view'] = $this->view + 1;
		parent::UpdateViewProcess($param);
	}
	public function UpdateRead($param){
		parent::UpdateReadProcess($param);
	}

	public function EditProduct($param){
		parent::EditProductProcess($param);
	}

	public function DeleteProduct($param){
		parent::DeleteProductProcess($param);
	}

	private function RenderProduct($mode,$page_title,$data){
        foreach ($data as $var){
        	if($mode == "product"){
        		include'template/product/product.items.php';
        	}
        	else if($mode == "subproduct"){
        		include'template/product/subproduct.items.php';
        	}
        	else if($mode == "subphoto"){
        		include'template/product/subphoto.items.php';
        	}
        }
        unset($data);
    }

    // Export to json
	public function ExportJson($product_id,$current_order_id){
		$dataset = parent::GetProductProcess(array('product_id' => $product_id,'order_id' => $current_order_id,));

		$data = array(
			"apiVersion" => "1.0",
			"data" => array(
				// "update" => time(),
				"time_now" => date('Y-m-d H:i:s'),
				"message" => 'message',
				"execute" => round(microtime(true)-StTime,4)."s",
				"totalFeeds" => floatval(count($dataset)),
				"items" => $dataset,
			),
		);

	    // JSON Encode and Echo.
	    echo json_encode($data);
	}
}
?>