<?php
class CategoryController extends CategoryModel{
    public function ListCategory($param){
        $data = parent::ListCategoryProcess($param);
        $this->RenderProduct($param['mode'],$param['current'],$data);
    }

    private function RenderProduct($mode,$current,$data){
        foreach ($data as $var){
            if($mode == "filter"){
                include'template/category/category.items.php';
            }
            else if($mode == "index"){
                include'template/category/category.index.items.php';
            }
        }
        unset($data);
    }
}
?>