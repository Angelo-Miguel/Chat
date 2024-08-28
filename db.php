<?php
/* Desativa os erros do php */
mysqli_report(MYSQLI_REPORT_OFF);
session_start();

$servidor = "localhost";
$usuario = "root";
/* colocar senha depois */
$senha = "";
$database = "chat";

$conexao = @mysqli_connect($servidor, $usuario, $senha, $database);
if (isset($_SESSION['login'])) {
    $nome_usuario = $_SESSION['usuario'];
    $query = "SELECT * FROM usuarios where usuario = '$nome_usuario'";
    $consulta_login = mysqli_query($conexao, $query);
    $id_usuario = (mysqli_fetch_assoc($consulta_login))['id_usuarios'] ?? 0;
    mysqli_data_seek($consulta_login, 0);

    $query = "SELECT * FROM amigos inner join usuarios on id_user2 = id_usuarios where id_user1 =  $id_usuario";
    $consulta_amigos = mysqli_query($conexao, $query);

    /* RECENTES */
    $query = "SELECT count(distinct id_user2) as qtd_amigos FROM msg WHERE id_user1 = $id_usuario";
    $consulta_qtd_amigos = mysqli_query($conexao, $query);
    $qtd_amigos = (mysqli_fetch_assoc($consulta_qtd_amigos)['qtd_amigos']);
    $query = "SELECT amigos.*, usuarios.*, m.* 
    FROM amigos 
    INNER JOIN usuarios ON amigos.id_user2 = usuarios.id_usuarios 
    INNER JOIN (
        SELECT id_user1, id_user2, MAX(CONCAT(dia, ' ', hora)) AS ultima_msg 
        FROM msg 
        WHERE (id_user1, id_user2) IN (SELECT id_user1, id_user2 FROM amigos) 
        GROUP BY id_user1, id_user2
    ) AS ultima_msg ON (
        (amigos.id_user1 = ultima_msg.id_user1 AND amigos.id_user2 = ultima_msg.id_user2) OR 
        (amigos.id_user1 = ultima_msg.id_user2 AND amigos.id_user2 = ultima_msg.id_user1)
    ) 
    INNER JOIN msg AS m ON (m.id_user1 = amigos.id_user1 AND m.id_user2 = amigos.id_user2 AND m.dia = SUBSTRING(ultima_msg.ultima_msg, 1, 10) AND m.hora = SUBSTRING(ultima_msg.ultima_msg, 12)) 
    WHERE amigos.id_user1 = $id_usuario 
    ORDER BY m.dia DESC, m.hora DESC 
    LIMIT $qtd_amigos;";
    $consulta_recentes = mysqli_query($conexao, $query);

    $amigo_selecionado = $_SESSION['amigo_selecionado'] ?? 0;
    $query = "SELECT * FROM msg inner join usuarios on msg.id_user1=usuarios.id_usuarios where msg.id_user1 = '$amigo_selecionado' and msg.id_user2 = $id_usuario or msg.id_user2 = '$amigo_selecionado' and msg.id_user1 = $id_usuario order by dia asc, hora asc";
    $consulta_msg = mysqli_query($conexao, $query);

    $query = "SELECT * FROM usuarios WHERE id_usuarios = '$amigo_selecionado'";
    $consulta_amigo_selecionado = mysqli_query($conexao, $query);    
}
