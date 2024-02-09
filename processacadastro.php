<?php 
    include 'db.php';

    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $senha = md5($_POST['senha']);

    $query = "INSERT INTO USUARIOS VALUES (default,'$usuario','$email','$senha')";
    mysqli_query($conexao,$query);

    header("location:index.php");