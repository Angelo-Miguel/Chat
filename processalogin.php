<?php
include 'db.php';

$usuario = addslashes($_POST['usuario']);
$senha = md5($_POST['senha']);

$query = "SELECT id_usuarios FROM USUARIOS WHERE usuario = '$usuario' and senha = '$senha' limit 1";
$consulta_senha = mysqli_query($conexao, $query);

if (mysqli_num_rows($consulta_senha) == 1) {
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_user'] = (mysqli_fetch_assoc($consulta_senha))['id_usuarios'] ?? null;

    header('location:index.php');
} else {
    header('location:index.php?erro_login');
}