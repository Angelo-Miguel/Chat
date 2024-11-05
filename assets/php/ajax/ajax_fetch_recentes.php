<?php
include '../db.php';

while ($linha = mysqli_fetch_array($consulta_recentes)) {
    $conteudoArquivo = $linha['imagem'];
?>
    <div class="user">
        <a href="#" onclick="changeUserChat(<?= $linha['id_usuarios'] ?>)">
            <img class="img-perfil" src="data:image;base64, <?= base64_encode($conteudoArquivo) ?>" alt="foto de perfil do <?= $linha['usuario'] ?>">
            <span class="nome"><?= $linha['usuario'] ?></span>
            <?php if ($linha['favorito'] == 1) { ?>
                <i class=" fa-solid fa-star recent-star"></i>
            <?php } ?>
        </a>
    </div>
<?php
}
?>