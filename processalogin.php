<?php 
    include 'db.php';

    $usuario = addslashes($_POST['usuario']);
    $senha = md5($_POST['senha']);

    $query = "SELECT id_usuarios FROM USUARIOS WHERE usuario = '$usuario' and senha = '$senha'";
    $consulta_senha = mysqli_query($conexao,$query);
    while ($linha = mysqli_fetch_array($consulta_senha)) {
        $id_user = $linha['id_usuarios'];
    }

    if (mysqli_num_rows($consulta_senha) == 1) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id_user'] = $id_user;
        
        header('location:index.php');
    }else{
    header('location:index.php?erro');
    }