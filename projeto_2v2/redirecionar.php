<?php
session_start();

if(!isset($_SESSION['USU_EMAIL'])){
header("Location: login.php");
exit;
}
?>