<?php 
    mysqli_report(MYSQLI_REPORT_OFF);
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "chat";
    

    $conexao = @mysqli_connect($servidor,$usuario,$senha,$database);
    if(isset($_SESSION['login'])){
        $nome_usuario = $_SESSION['usuario'];
        $query = "SELECT id_usuarios FROM usuarios where usuario = '$nome_usuario'";
        $consulta_id_usuario = mysqli_query($conexao,$query);
        while ($linha = mysqli_fetch_array($consulta_id_usuario)) {
            $id_usuario = $linha['id_usuarios'];
        }

        $query = "SELECT usuario FROM amigos inner join usuarios on id_user2 = id_usuarios where id_user1 =  $id_usuario";
        $consulta_amigos = mysqli_query($conexao,$query);

        /* fazer recentes */
        $query = "SELECT usuario FROM amigos inner join usuarios on id_user2 = id_usuarios where id_user1 =  $id_usuario";
        $consulta_recentes = mysqli_query($conexao,$query);

        $query = "SELECT * FROM msg inner join usuarios on msg.id_user1=id_usuarios where msg.id_user1 = '1' or msg.id_user2 = '1'";
        $consulta_msg = mysqli_query($conexao,$query);
    }