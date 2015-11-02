<?php
class ProductController extends ProductModel{
	public $id;
	public $parent;
	public $code;
	public $title;
	public $description;
	public $quantity;
	public $price;
    public $view;
    public $read;
    public $interest_ratio;
	public $create_time;
	public $update_time;
	public $group;
	public $type;
	public $status;

    public $total_in_order;

	// Image of product
	public $image_id;
	public $image_filename;
	public $image_format;

	public function GetProduct($param){
        $data = parent::GetProductProcess($param);

        $this->id = $data['pd_id'];
        $this->parent = $data['pd_parent'];
        $this->code = $data['pd_code'];
        $this->title = $data['pd_title'];
        $this->description = $data['pd_description'];
        $this->quantity = $data['pd_quantity'];
        $this->price = $data['pd_price'];
        $this->view = $data['pd_view'];
        $this->read = $data['pd_read'];

        if($this->view == 0){
            $this->interest_ratio = 0;
        }
        else{
            $this->interest_ratio = (($this->read*100)/$this->view);    
        }
        
        $this->create_time = $data['pd_create_time'];
        $this->update_time = $data['pd_update_time'];
        $this->group = $data['pd_group'];
        $this->type = $data['pd_type'];
        $this->status = $data['pd_status'];

        $this->image_id = $data['im_id'];
        $this->image_filename = $data['im_filename'];
        $this->image_format = $data['im_format'];

        $this->total_in_order = $data['total_in_order'];
    }	

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->Render('product-items',$dataset);
	}

	public function ListSubProduct($param){
		$dataset = parent::ListSubProductProcess($param);
		$this->Render($param['render'],$dataset);
	}

	// List all photos of Product.
	public function ListPhotoProduct($param){
		$dataset = parent::ListPhotoProductProcess($param);
		$this->Render('photo-items',$dataset);
	}

	public function CreateProduct($param){
		return parent::CreateProductProcess($param);
	}

	public function EditProduct($param){
		parent::EditProductProcess($param);
	}

	public function UpdateRootProduct($param){
		parent::UpdateRootProductProcess($param);
	}

	public function DeleteProduct($param){
		parent::DeleteProductProcess($param);
	}

	private function Render($mode,$data){
        foreach ($data as $var){
        	if($mode == "product-items"){
        		include'template/product/product.items.php';
        	}
        	else if($mode == "list-subproduct-items"){
        		include'template/product/list.subproduct.items.php';
        	}
        	else if($mode == "photo-items"){
        		include'template/product/photo.product.items.php';
        	}
        	else if($mode == "subproduct-items"){
        		include'template/product/subproduct.items.php';
        	}
        }
        unset($data);
    }

    // Autosetup last photo to cover of product. (Create product function)
    public function AutosetCover($param){
    	// Check Cover already
    	if(parent::CoverAlreadyProcess($param)){
    		// Autoset Last file to Cover
    		parent::AutosetCover($param);
    	}
    }

    public function SetCover($param){
    	parent::SetCoverProcess($param);
    }

    public function DeletePhoto($param){
        parent::DeletePhotoProcess($param);
    }


    public function UpdateQuantity($param){

        // Get Product ////////////////////
        $this->GetProduct(array('product_id' => $param['product_id']));

        if($param['action'] == "import"){
            $quantity = $this->quantity + $param['quantity'];
        }
        else if($param['action'] == "export"){
            $quantity = $this->quantity - $param['quantity'];
        }
        else{
            return false;
        }

        // Update Quantity Process /////////
        parent::UpdateQuantityProcess(array(
            'product_id'    => $param['product_id'],
            'quantity'      => $quantity,
        ));

        
        // Tasks todo Create Product activity. ////
        parent::CreateProductActivityProcess(array(
            'admin_id'      => 0,
            'product_id'    => $param['product_id'],
            'action'        => $param['action'],
            'value'         => $param['quantity'],
            'message'       => $param['message'],
        ));
    }
}
?>