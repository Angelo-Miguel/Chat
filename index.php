<?php
    session_start();

    include 'db.php';
    include 'header.php';

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
            include './views/cadastro.php';
            break;
        case 'chat':
            include './views/chat.php';
            break;
        case 'logout':
            include 'logout.php';
            break;
        default:
            include 'views/login.php';
            break;
    }

    include 'footer.php';