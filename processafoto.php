<?php
include './db.php';
// Verifica se o arquivo foi enviado sem erros
if ($_FILES["imagem"]["error"] == 0) {
    $nomeArquivo = $_FILES["imagem"]["name"];
    $conteudoArquivo = mysqli_real_escape_string($conexao, file_get_contents($_FILES["imagem"]["tmp_name"]));

    $sql = "UPDATE USUARIOS SET imagem = '$conteudoArquivo' WHERE id_usuarios = '3'";
    // Executa a instrução SQL
    if (mysqli_query($conexao, $sql)) {
        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a imagem: " . mysqli_error($conexao);
    }
} else {
    echo "Erro ao fazer upload da imagem.";
}

//header('location:index.php');
