<?php 
session_start(); 
unset($_SESSION['minazi_auth']);
unset($_SESSION['minazi-id']);
unset($_SESSION['minazi-role']);
header("location: login.php"); exit;
?>