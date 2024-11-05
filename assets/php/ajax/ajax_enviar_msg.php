<?php
include '../db.php';
date_default_timezone_set('America/Sao_Paulo');
$hora = date('H:i:s');
$dia = date("Y-m-d");

$texto = $_POST['text'];
$id_user = $_SESSION['id_user'];

$query = "INSERT INTO msg VALUES(default,'$id_user','$amigo_selecionado','$texto','$hora','$dia',default)";
mysqli_query($conexao,$query);