<?php 
include 'db.php';

$usuario = addslashes($_POST['usuario']);
$senha = $_POST['senha'];

$query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario' and senha = '$senha'";
$consulta_senha = mysqli_query($conexao,$query);

if (mysqli_num_rows($consulta_senha) == 1) {
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $usuario;
    
    header('location:index.php');
}else{
   header('location:index.php?erro');
}
?>