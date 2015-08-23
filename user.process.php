<?php
require_once'config/autoload.php';

if(empty($_POST['product_id'])){
    $product_id = $product->CreateProduct(array(
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'material' => $_POST['material'],
        'size_d' => $_POST['size_d'],
        'size_ss' => $_POST['size_ss'],
        'size_s' => $_POST['size_s'],
        'size_m' => $_POST['size_m'],
        'size_l' => $_POST['size_l'],
        'size_xl' => $_POST['size_xl'],
        'price' => $_POST['price'],
        'group' => $_POST['group'],
        'type' => 'normal',
        'status' => 'active',
    ));
}
?>