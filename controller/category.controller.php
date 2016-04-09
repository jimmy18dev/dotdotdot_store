<?php
class CategoryController extends CategoryModel{
    public function ListCategory($param){
        $data = parent::ListCategoryProcess($param);
        $this->RenderProduct($param['mode'],$param['current'],$data);
    }

    private function RenderProduct($mode,$current,$data){
        $count = parent::countCategory();

        $loop = 1;
        foreach ($data as $var){
            if($mode == "filter"){
                include'template/category/category.items.php';
            }
            else if($mode == "index"){
                if($count % 2 == 1 && $loop == 1)
                    $spacail_style = 'category-items-fullsize';
                else
                    $spacail_style = '';
                
                include'template/category/category.index.items.php';
            }

            $loop++;
        }
        unset($data);
    }
}
?>