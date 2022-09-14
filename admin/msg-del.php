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
    $op->where('msg_i',$id);
    $op->delete(messages);
    $_SESSION['minazi_mgs'] = '$.notify("Message Deleted!", "success");';
	echo '<script>window.location="'.admin_base.'messages.php";</script>';exit;
}