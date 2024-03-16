<?php 
    session_start();
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

        $query = "SELECT * FROM amigos inner join usuarios on id_user2 = id_usuarios where id_user1 =  $id_usuario";
        $consulta_amigos = mysqli_query($conexao,$query);

        /* fazer recentes */


        $amigo_selecionado = $_SESSION['amigo_selecionado']  ?? 0;
        $query = "SELECT * FROM msg inner join usuarios on msg.id_user1=usuarios.id_usuarios where msg.id_user1 = '$amigo_selecionado' and msg.id_user2 = $id_usuario or msg.id_user2 = '$amigo_selecionado' and msg.id_user1 = $id_usuario;";
        $consulta_msg = mysqli_query($conexao,$query);

        $query = "SELECT * FROM usuarios WHERE id_usuarios = '$amigo_selecionado'";
        $consulta_amigo_selecionado = mysqli_query( $conexao, $query );
    }