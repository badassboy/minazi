<?php 
require_once 'inc/statics.php';
require_once 'inc/MysqliDb.php';
session_start();

if($_SESSION['minazi_auth'] == false) {
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
	exit;
}

if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $op = new MysqliDb(hostName, userName, userPass, hostDb);
    $op->where('p_id',$id);
    $op->delete(products);
    $_SESSION['minazi_mgs'] = '$.notify("Product Deleted!", "success");';
	echo '<script>window.location="'.admin_base.'products.php";</script>';exit;
}