<?php
include 'assets/php/db.php';
include 'assets/php/header.php';

if (isset($_SESSION['login'])) {
    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
    } else {
        $pagina = 'chat';
    }
} elseif (isset($_GET['cadastro'])) {
    $pagina = "cadastro";
} else {
    $pagina = 'login';
}

switch ($pagina) {
    case 'cadastro':
        include './views/cadastro.html';
        break;
    case 'chat':
        include './views/chat.php';
        break;
    case 'logout':
        include 'assets/php/logout.php';
        break;
    default:
        include 'views/login.php';
        break;
}

include 'assets/php/footer.php';
