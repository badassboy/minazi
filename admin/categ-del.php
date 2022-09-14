<?php 
require_once 'inc/statics.php';
require_once 'inc/MysqliDb.php';
session_start();
ob_start();

if($_SESSION['minazi_auth'] == false) {
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
}

if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $op = new MysqliDb(hostName, userName, userPass, hostDb);
    $op->where('cat_id',$id);
    $op->delete(categories);
    $_SESSION['minazi_mgs'] = '$.notify("Category Deleted!", "success");';
	echo '<script>window.location="'.admin_base.'categories.php";</script>';exit;
}