<?php
class ProductController extends ProductModel{
	public $status = 'Call ProductController success.';

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->Render('null',$dataset);
	}

	private function Render($mode,$data){
        foreach ($data as $var){
        	include'template/product/product.items.php';
        }
        unset($data);
    }
}
?>