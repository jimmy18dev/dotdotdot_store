<?php
require_once'config/autoload.php';

$bank->CreateMoneyTransfer(array(
    'order_id'      => $_POST['order_id'],
    'to_bank'       => $_POST['to_bank'],
    'member_id'     => MEMBER_ID,
    'total'         => $_POST['total'],
    'description'   => $_POST['description'],
    'type'          => 'bank_transfer',
));

$order->OrderProcess(array(
    'member_id'     => MEMBER_ID,
    'order_id'      => $_POST['order_id'],
    'order_action'  => 'TransferRequest',
));
?>