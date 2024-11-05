<?php
session_start();
include './db.php';
$id_user = $_SESSION['id_user'];

$nome =  $_POST['name'];
$query = "UPDATE usuarios set usuario = '$nome' where id_usuarios = $id_user";
$_SESSION['usuario'] = $nome;
mysqli_query($conexao, $query);

// Nao deixa o modal fechar
$_SESSION['modal'] = 'modalConfig';

header('location:index.php');
