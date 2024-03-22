    <div class="chat">
        <div class="menu-lateral">
            <?php
            while ($linha = mysqli_fetch_array($consulta_amigos)) {
                $conteudoArquivo = $linha['imagem'];
                echo "<div class='user'>";
                echo "<a href='processaselecao.php?amigo_selecionado=" . $linha['id_usuarios'] . "'><img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'>" . $linha['usuario'] . "</a>";
                echo "</div>";
            }
            mysqli_data_seek($consulta_amigos, 0);

            ?>
        </div>

        <div class="content">
            <header>
                <h1 class="header-gap"></h1>
                <h1 class="header-gap">Chat</h1>
                <div class="header-gap perfil">
                    <?php
                    $conteudoArquivo = (mysqli_fetch_assoc($consulta_login))['imagem'] ?? null;
                    echo "<img class='avatar img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $_SESSION['usuario'] . "'>";
                    ?>
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
            <?php
            if ($amigo_selecionado != '0') {
            ?>
                <section>
                    <div class="content-header-chat">
                        <?php
                        while ($linha = mysqli_fetch_array($consulta_amigo_selecionado)) {
                            $conteudoArquivo = $linha['imagem'];
                            echo "<img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'>";
                            echo "<h3>" . $linha['usuario'] . "</h3>";
                        }
                        ?>
                    </div>
                    <div class="container-chat">
                        <div class="mensagens" id="msg">

                            <?php
                            $diaatual = '0/0';
                            while ($linha = mysqli_fetch_array($consulta_msg)) {
                                $dia = date('d/m', strtotime($linha['dia']));

                                if ($diaatual != $dia) {
                                    echo "<div class='dia'>" . $dia . "</div>";
                                    $diaatual = $dia;
                                }
                                if ($linha['id_user2'] == $_SESSION['id_user']) {
                                    echo "<div class='msg1'>";
                                    echo "<div>" . $linha['msg'] . "<span class='inv'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></div>";
                                    echo "<div class='horas'>" . date('H:i', strtotime($linha['hora'])) . "</div>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='msg2'>";
                                    echo "<div>" . $linha['msg'] . "<span class='inv'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></div>";
                                    echo "<div class='horas'>" . date('H:i', strtotime($linha['hora'])) . "</div>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                        <form class="escrever" action="enviarmsg.php" method="post">
                            <input type="text" name="text" class="msg" required minlength="1">
                            <input type="submit" value="Enviar" class="msgenviar">
                        </form>
                    </div>
                </section>
            <?php
            } else {
            ?>
                <!-- Arumar isso depois | tela quando nao tem nenhum amigo selecionado-->
                <div style="height: 82.5vh"></div>
            <?php
            }
            ?>

            <!-- Modal da aba Amigos -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="aba-amigos">
                        <h2>Amigos</h2>
                        <form class='form-amigos' action="./processaamigos.php" method="post">
                            <input type="text" placeholder="Nome de usuário" name="usuario">
                            <input type="text" placeholder="ID" name="id">
                            <input type="submit" value="Adicionar">
                        </form>
                        <table id="amigos" class="lista-amigos display">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Favoritar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($linha = mysqli_fetch_array($consulta_amigos)) {
                                    echo "<tr class='amigo'>";
                                    echo "<td><div class='nome'><img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'><p>" . $linha['usuario'] . "</p></div></td>";
                                    echo "<td><a href='#'>Favorito</a></td>";
                                    echo "<td><a href='#'>Excluir</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
            //erro ao adicionar os amigos
            if (isset($_SESSION['erro_amigo_n_encontrado'])) {
                echo '<script>alert("Usuário ou Id inválidos");</script>';
                unset($_SESSION['erro_amigo_n_encontrado']);
            }
            if (isset($_SESSION['erro_mesmo_amigo'])) {
                echo '<script>alert("Usuário já adicionado");</script>';
                unset($_SESSION['erro_mesmo_amigo']);
            }
            if (isset($_SESSION['modal'])) {
                // Se verdadeiro, exibe o modal
                echo "<script>document.getElementById('myModal').style.display = 'block';</script>";
                unset($_SESSION['modal']);
            }
            ?>