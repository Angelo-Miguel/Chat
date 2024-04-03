<?php 
include './db.php';

$id_deletar = $_GET ['id_deletar'];
$id_user = $_SESSION['id_user'];

$query = "DELETE FROM amigos where (id_user1 = '$id_user' AND id_user2 = '$id_deletar') or (id_user2 = '$id_user' AND id_user1 = '$id_deletar')";
mysqli_query($conexao,$query);

echo "$id_deletar";
echo "$id_user";

if ($_SESSION['amigo_selecionado'] = $id_deletar) {
    $_SESSION['amigo_selecionado'] = 0;
}

// Nao deixa o modal fechar
$_SESSION['modal'] = 'modalAmigos';

header('location:index.php');