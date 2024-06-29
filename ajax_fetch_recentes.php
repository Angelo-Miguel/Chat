<?php
include './db.php';

while ($linha = mysqli_fetch_array($consulta_recentes)) {
    $conteudoArquivo = $linha['imagem'];
    echo "<div class='user'>";
    echo "<a href='processaselecao.php?amigo_selecionado=" . $linha['id_usuarios'] . "'><img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'><span class='nome'>" . $linha['usuario'] . "</span></a>";
    echo "</div>";
}