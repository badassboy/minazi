<?php 
session_start(); 
unset($_SESSION['mz_auth']);
unset($_SESSION['mz-cust-id']);
header("location: index.php"); exit;
?>