<?php
class ProductController extends ProductModel{
	public $id;
	public $title;
	public $description;
	public $material;
	public $size_d;
	public $size_ss;
	public $size_s;
	public $size_m;
	public $size_l;
	public $size_xl;
	public $price;
	public $create_time;
	public $update_time;
	public $group;
	public $type;
	public $status;

	// Image of product
	public $image_id;
	public $image_thumbnail;
	public $image_square;
	public $image_mini;
	public $image_normal;
	public $image_large;
	public $image_format;

	public function GetProduct($param){
        $data = parent::GetProductProcess($param);

        $this->id = $data['pd_id'];
        $this->title = $data['pd_title'];
        $this->description = $data['pd_description'];
        $this->material = $data['pd_material'];
        $this->size_d = $data['pd_size_d'];
        $this->size_ss = $data['pd_size_ss'];
        $this->size_s = $data['pd_size_s'];
        $this->size_m = $data['pd_size_m'];
        $this->size_l = $data['pd_size_l'];
        $this->size_xl = $data['pd_size_xl'];
        $this->price = $data['pd_price'];
        $this->create_time = $data['pd_create_time'];
        $this->update_time = $data['pd_update_time'];
        $this->group = $data['pd_group'];
        $this->type = $data['pd_type'];
        $this->status = $data['pd_status'];

        $this->image_id = $data['im_id'];
        $this->image_thumbnail = $data['im_thumbnail'];
        $this->image_square = $data['im_square'];
        $this->image_mini = $data['im_mini'];
        $this->image_normal = $data['im_normal'];
        $this->image_large = $data['im_large'];
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

	private function Render($mode,$data){
        foreach ($data as $var){
        	include'template/product/product.items.php';
        }
        unset($data);
    }
}
?>