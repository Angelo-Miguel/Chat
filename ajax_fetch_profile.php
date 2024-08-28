<?php
include 'db.php';

while ($linha = mysqli_fetch_array($consulta_amigo_selecionado)) {
    $conteudoArquivo = $linha['imagem'];
    echo "<img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'>";
    echo "<h4>" . $linha['usuario'] . "</h4>";
}
