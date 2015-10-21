<?php
class ProductController extends ProductModel{
	public $id;
	public $parent;
	public $code;
	public $title;
	public $description;
	public $unit;
	public $price;
	public $create_time;
	public $update_time;
	public $group;
	public $type;
	public $status;

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
        $this->unit = $data['pd_unit'];
        $this->price = $data['pd_price'];
        $this->create_time = $data['pd_create_time'];
        $this->update_time = $data['pd_update_time'];
        $this->group = $data['pd_group'];
        $this->type = $data['pd_type'];
        $this->status = $data['pd_status'];

        $this->image_id = $data['im_id'];
        $this->image_filename = $data['im_filename'];
        $this->image_format = $data['im_format'];

    }

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->Render('null',$dataset);
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
        	include'template/product/product.items.php';
        }
        unset($data);
    }
}
?>