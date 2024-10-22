<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: vista/logi.php'); 
    exit(); 
}
$request_uri = $_SERVER['REQUEST_URI'];
if ($request_uri !== '/proyecto/vista/logi.php' && !isset($_SESSION['usuario'])) {
    header('Location: vista/logi.php');
    exit();
}
?>