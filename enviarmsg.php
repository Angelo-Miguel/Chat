<?php 

include 'db.php';

date_default_timezone_set('America/Sao_Paulo');
$hora = date('H:i');
$dia = date("Y-m-d");
echo $dia;
$texto = $_POST['text'];
$id_user = $_SESSION['id_user'];

$query = "INSERT INTO msg VALUES(default,'$id_user','$amigo_selecionado','$texto','$hora','$dia')";
mysqli_query($conexao,$query);

header('location:index.php');