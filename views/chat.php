<div class="menu-lateral">
    <?php
    while ($linha = mysqli_fetch_array($consulta_recentes)) {
        echo "<div class='user'>";
        echo "<a href='#'><img src='./assets/img/noUser.png' alt='" . $linha['usuario'] . "'>" . $linha['usuario'] . "</a>";
        echo "</div>";
    }
    ?>

</div>

<div class="content">
    <header>
        <h1 class="header-gap"></h1>
        <h1 class="header-gap">Chat</h1>
        <div class="header-gap perfil">
            <img class="avatar" src="./assets/img/noUser.png" alt="Foto de perfil">
            <div class="nome-id">
                <span><?= $_SESSION['usuario'] ?></span><br>
                <span>ID: <?= $_SESSION['id_user'] ?></span>
            </div>
        </div>
    </header>

    <nav>
        <a id="openModal">Amigos</a>
        <a href="#!">Configurações</a>
        <a href="./logout.php">Sair</a>
    </nav>
    <section>
        <div class="container">
            <div class="chat">
                                <div class="mensagens">
                    <?php
                    while ($linha = mysqli_fetch_array($consulta_msg)) {
                        if ($linha['id_user2'] == $_SESSION['id_user']) {
                            echo "<div class='msg1'>
                        <div class='texto'>" . $linha['msg'] . "</div>
                        <div class='horas'>" . $linha['hora'] . "</div>
                    </div>";
                        } else {
                            echo "<div class='msg2'>
                                                <div class='texto'>" . $linha['msg'] . "</div>
                        <div class='horas'>" . $linha['hora'] . "</div>
                    </div>";
                        }
                    }
                    ?>
                </div>
                <form class="escrever formulario">
                    <input type="text" name="text" class="msg">
                    <input type="submit" value="Enviar" class="msgenviar">
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Chat. Todos os direitos reservados.</p>
    </footer>
</div>

<?php
//erro ao adicionar os amigos
if (isset($_SESSION['erro_amigos'])) {
    echo '<script>alert("Usuário ou Id inválidos");</script>';
    unset($_SESSION['erro_amigos']);
} else if (isset($_SESSION['erro_mesmo_amigo'])) {
    echo '<script>alert("Usuário já adicionado");</script>';
    unset($_SESSION['erro_mesmo_amigo']);
}
?>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Amigos</h2>
        <form action="./processaamigos.php" method="post">
            <input type="text" class="search-input" placeholder="Nome de usuário" name="usuario">
            <input type="text" class="search-input" placeholder="ID" style="width: 10%;" name="id">
            <input type="submit" class="add-friend" value="Adicionar">
        </form>
        <table class="friend-list teste">
            <?php
            while ($linha = mysqli_fetch_array($consulta_amigos)) {
                echo "<tr class='friend-item'>";
                echo "<td><img src='./assets/img/noUser.png' alt='" . $linha['usuario'] . "'></td>";
                echo "<td><span class='friend-name'>" . $linha['usuario'] . "</span></td>";
                echo "<td><a href='#'>Favorito</a></td>";
                echo "<td><a href='#'>Excluir</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>