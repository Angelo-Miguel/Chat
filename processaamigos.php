<?php
session_start();
include 'db.php';

$usuario = addslashes($_POST['usuario']);
$id_usuario1 = addslashes($_POST['id']);
$self_id = $_SESSION['id_user'];


$query = "SELECT * FROM USUARIOS WHERE usuario = '$usuario' AND id_usuarios = '$id_usuario1'";
$result = mysqli_query($conexao, $query);

$query = "SELECT * FROM amigos WHERE id_user1 = '$id_usuario1' and id_user2 = '$self_id'";
$verifica_amizade = mysqli_query($conexao, $query);
if (mysqli_num_rows($verifica_amizade) == 0) {
    if (mysqli_num_rows($result) == 1) {
        $query = "INSERT INTO amigos (id_user1, id_user2) VALUES ($id_usuario1, $self_id)";
        mysqli_query($conexao, $query);
        $query = "INSERT INTO amigos (id_user1, id_user2) VALUES ($self_id, $id_usuario1)";
        mysqli_query($conexao, $query);
    } else {
        $_SESSION['erro_amigo_n_encontrado'] = true;
    }
} else {
    $_SESSION['erro_mesmo_amigo'] = true;
}

// Nao deixa o modal fechar
$_SESSION['modal'] = 'modalAmigos';

header("location:index.php");