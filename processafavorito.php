<?php 
include 'db.php';

$id_amigo = $_POST['id'];
$favorito = $_POST['favorito'];
$meu_id = $_SESSION['id_user'];

$query = "UPDATE amigos SET favorito = $favorito WHERE id_user2 = $id_amigo AND id_user1 = $meu_id";
mysqli_query($conexao,$query);