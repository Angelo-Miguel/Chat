<?php
include './db.php';

$id_msg = $_POST['id'];

$query = "UPDATE msg SET visto = 1 WHERE id_msg = $idmsg";
mysqli_query($conexao, $query);
