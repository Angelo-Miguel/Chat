<?php
include './db.php';

$id_user = $_SESSION['id_user'];
$conteudoArquivo = file_get_contents($_FILES["profilePic"]["tmp_name"]);

// Converte o conteúdo do arquivo em um formato seguro para uso em consultas SQL
$conteudoArquivo = mysqli_real_escape_string($conexao, $conteudoArquivo);
$query = "UPDATE usuarios SET imagem = '$conteudoArquivo' WHERE id_usuarios = '$id_user'";
mysqli_query($conexao, $query);

// Nao deixa o modal fechar
$_SESSION['modal'] = 'modalConfig';

header('location:index.php');