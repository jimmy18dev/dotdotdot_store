<?php
class ProductController extends ProductModel{
	public $status = 'Call ProductController success.';

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->Render('null',$dataset);
	}

	public function CreateProduct($param){
		parent::CreateProductProcess($param);
	}

	private function Render($mode,$data){
        foreach ($data as $var){
        	include'template/product/product.items.php';
        }
        unset($data);
    }
}
?>