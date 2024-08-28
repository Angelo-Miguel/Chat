<?php
include './db.php';

while ($linha = mysqli_fetch_array($consulta_recentes)) {
    $conteudoArquivo = $linha['imagem'];
    echo "<div class='user'>";
    echo "<a href='#' onclick='changeUserChat(" . $linha['id_usuarios'] . "); return false;'>
        <img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'>
        <span class='nome'>" . $linha['usuario'] . "</span>
    </a>";
    echo "</div>";
}
?>