<div class="menu-lateral">
    <?php
    while ($linha = mysqli_fetch_array($consulta_amigos)) {
        echo "<div class='user'>";
        echo "<a href='#'><img src='./assets/img/noUser.png' alt='".$linha['usuario']."'>".$linha['usuario']."</a>";
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
            <p class="nome-usuario"><?= $_SESSION['usuario'] ?></p>
        </div>
    </header>

    <nav>
        <a href="#">Amigos</a>
        <a href="./logout.php">Sair</a>
    </nav>

    <section>
        <div class="container">
            <div class="chat">
                <div class="mensagens">
                    <div class="msg1">
                        <a href="#"><img src="./assets/img/noUser.png" alt="User 1"> user1</a>
                        <div class="msg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus magni ullam nemo dolore nostrum nesciunt nisi corporis error. lorem32</div>
                        <div class="horas">18:32</div>
                    </div>
                    <div class="msg2">
                        <a href="#"><img src="./assets/img/noUser.png" alt="User 2"> user2</a>
                        <div class="msg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus magni ullam nemo dolore nostrum nesciunt nisi corporis error.</div>
                        <div class="horas">18:32</div>
                    </div>
                    <div class="msg2">
                        <a href="#"><img src="./assets/img/noUser.png" alt="User 2"> user2</a>
                        <div class="msg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus magni ullam nemo dolore nostrum nesciunt nisi corporis error.</div>
                        <div class="horas">18:32</div>
                    </div>
                    <div class="msg1">
                        <a href="#"><img src="./assets/img/noUser.png" alt="User 1"> user1</a>
                        <div class="msg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus magni ullam nemo dolore nostrum nesciunt nisi corporis error. lorem32</div>
                        <div class="horas">18:32</div>
                    </div>
                    <div class="msg2">
                        <a href="#"><img src="./assets/img/noUser.png" alt="User 2"> user2</a>
                        <div class="msg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus magni ullam nemo dolore nostrum nesciunt nisi corporis error.</div>
                        <div class="horas">18:32</div>
                    </div>

                </div>
                <div class="escrever">
                    <input type="text" name="text" id="text">
                    <input type="submit" value="Enviar">
                </div>
            </div>
        </div>
    </section>
    <footer>
    <p>&copy; 2024 Chat. Todos os direitos reservados.</p>
</footer>
</div>


<!-- <div class="user">
        <a href="#"><img src="./assets/img/noUser.png" alt="User 1"> user1</a>
    </div> -->