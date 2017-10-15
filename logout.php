<?php
session_start();
if(!isset($_SESSION['active'])) {
	header('Location: ./index.php');
	exit();
}
$_SESSION = array();
setcookie(session_name(),"",-1,"/");
session_destroy(); 
if(!isset($_SESSION['active'])) {
	header('Location: ./index.php');
	exit();
}
?>
