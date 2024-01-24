<?php
    session_start();

    #base de dados
    include 'db.php';
    
    #cabeçario
    include 'header.php';

    if(isset($_SESSION['login'])){
        if(isset($_GET['pagina'])){
            $pagina = $_GET['pagina'];
        }else{
            $pagina = 'chat';
        }
    }
    else{
        $pagina = 'login';
    }


    switch ($pagina) {
        case 'chat':include './views/chat.php';break;
        case 'logout': include 'logout.php'; break;
        

        default: include 'views/login.php'; break;
    }


    #rodapé
    include 'footer.php';

?>