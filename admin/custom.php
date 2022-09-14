<?php 
require_once 'inc/statics.php';
require_once 'inc/MysqliDb.php';
session_start();

if($_SESSION['minazi_auth'] == false) {
	echo '<script>window.location="'.admin_base.'login.php";</script>';exit;
	exit;
}

if(isset($_REQUEST['id']) && isset($_REQUEST['stat'])){
    $id = $_REQUEST['id'];
    $stat = $_REQUEST['stat'];
    $op = new MysqliDb(hostName, userName, userPass, hostDb);

    if($stat == 1){
        $tab = array(
            'c_status' => 0,
        );
        $op->where('c_id',$id);
        $op->update(customers,$tab);
        $_SESSION['minazi_mgs'] = '$.notify("Customer Deactivated!", "success");';
    }elseif($stat == 0){
        $tab = array(
            'c_status' => 1,
        );
        $op->where('c_id',$id);
        $op->update(customers,$tab);
        $_SESSION['minazi_mgs'] = '$.notify("Customer Activated!", "success");';
    }

	echo '<script>window.location="'.admin_base.'customers.php";</script>';exit;
}