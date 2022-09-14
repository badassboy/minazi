<?php
session_start();
include_once getcwd().'/inc/functions.php';

if($_SESSION['minazi_auth'] == false) {
	header('location: login.php');
	exit;
}

if(chkUrl() == 'index'){
    $title = 'Dashboard';
}elseif(chkUrl() == 'profi'){
    $title = 'Profile';
}elseif(chkUrl() == 'produ'){
    $title = 'Products';
}elseif(chkUrl() == 'messa'){
    $title = 'Messages';
}elseif(chkUrl() == 'categ'){
    $title = 'Categories';
}elseif(chkUrl() == 'custo'){
    $title = 'Customers';
}elseif(chkUrl() == 'order'){
    $title = 'Orders';
}elseif(chkUrl() == 'setti'){
    $title = 'Settings';
}else{
	$title = 'Admin';
}
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title><?=$title?> | <?=appName?></title>

	<link rel="stylesheet" href="css/bootstrap.css">
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/summernote.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>