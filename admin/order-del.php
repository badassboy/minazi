<?php 
require_once 'inc/statics.php';
require_once 'inc/MysqliDb.php';
session_start();

if($_SESSION['minazi_auth'] == false) {
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
	exit;
}

if(isset($_REQUEST['trans']) && !empty($_REQUEST['trans'])){
    $id = $_REQUEST['trans'];
    $op = new MysqliDb(hostName, userName, userPass, hostDb);
    $op->where('order_id',$id);
    $op->delete(orders);

    $op->where('order_id',$id);
    $op->delete(payments);

    $_SESSION['minazi_mgs'] = '$.notify("Order Deleted!", "success");';
	echo '<script>window.location="'.admin_base.'orders.php";</script>';exit;
}