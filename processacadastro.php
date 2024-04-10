<?php
include 'db.php';

$usuario = addslashes($_POST['usuario']);
$email = addslashes($_POST['email']);
$senha = md5($_POST['senha']);

// Le o conteúdo da imagem
$imagePath = './assets/img/noUser.png';
$conteudoArquivo = file_get_contents($imagePath);
$img = mysqli_real_escape_string($conexao, $conteudoArquivo);

$query = "INSERT INTO USUARIOS VALUES (default,'$usuario','$email','$senha','$img')";
mysqli_query($conexao, $query);

header("location:index.php");