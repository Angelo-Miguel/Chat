<?php 
session_start();
$_SESSION['amigo_selecionado']= $_GET['amigo_selecionado'];
header('location:index.php');