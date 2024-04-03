<?php
include './db.php';
$id_user = $_SESSION['id_user'];
$senhaAntiga = md5($_POST['currentPassword']);
$senhaNova = md5($_POST['newPassword']);
$query = "SELECT senha FROM usuarios where id_usuarios = '$id_user'";
$consulta_senha = mysqli_query($conexao, $query);
$senhaVerdade = (mysqli_fetch_assoc($consulta_senha))['senha'];

if (($senhaAntiga != $senhaNova) and ($senhaAntiga == $senhaVerdade)) {
    $query = "UPDATE usuarios set senha = '$senhaNova' where id_usuarios =  '$id_user'";
    mysqli_query($conexao, $query);
} elseif ($senhaAntiga != $senhaVerdade) {
    $_SESSION['erro_senha_errada'] = true;
} elseif ($senhaAntiga == $senhaNova) {
    $_SESSION['erro_mesma_senha'] = true;
}

// Nao deixa o modal fechar
$_SESSION['modal'] = 'modalConfig';

header('location:index.php');