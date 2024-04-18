    <div class="chat">
        <div id="sid-menu" class="menu-lateral">
            <div class="sid-title">
                <span class="close-sid"></span>
                <h3>Recentes</h3>
                <span class="close close-sid" onclick="closeMenu()">&times;</span>
            </div>
            <span id="recentes"></span>
        </div>

        <div class="content">
            <header>
                <h1 class="header-gap "><svg onclick="openMenu()" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="menu-sid-button" viewBox="0 0 16 16" style="display:none;">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg></h1>
                <h1 class="header-gap">Chat</h1>
                <div class="header-gap perfil">
                    <?php
                    $conteudoArquivo = (mysqli_fetch_assoc($consulta_login))['imagem'] ?? null;
                    echo "<img src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $_SESSION['usuario'] . "'>";
                    ?>
                    <div class="nome-id">
                        <span><?= $_SESSION['usuario'] ?></span><br>
                        <span>ID: <?= $_SESSION['id_user'] ?></span>
                    </div>
                </div>
            </header>

            <nav>
                <a onclick="openModal('modalAmigos')">Amigos</a>
                <a onclick="openModal('modalConfig')">Configurações</a>
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
                            echo "<h4>" . $linha['usuario'] . "</h4>";
                        }
                        ?>
                    </div>
                    <div class="container-chat">
                        <div class="mensagens" id="msg">
                            <!-- Mensagens serão adicionadas via ajax -->
                        </div>
                        <form class="escrever">
                            <input type="text" name="text" id="text" class="msg" required minlength="1">
                            <input type="submit" onclick="sendMessage(); return false" class="msgenviar" value="Enviar">
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
            <div id="modalAmigos" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('modalAmigos')">&times;</span>
                    <div class="modal-amigos">
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
                                    $conteudoArquivo = $linha['imagem'];
                                    echo "<tr class='amigo'>";
                                    echo "<td><a href='processaselecao.php?amigo_selecionado=" . $linha['id_usuarios'] . "'><div class='nome'><img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'><p>" . $linha['usuario'] . "</p></div></a></td>";
                                    echo "<td><a href='#'>Favorito</a></td>";
                                    echo "<td><a href='deletaamigo.php?id_deletar=" . $linha['id_usuarios'] . " '>Excluir</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Configurações -->
            <div id="modalConfig" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('modalConfig')">&times;</span>
                    <div class="modal-config">
                        <h2>Configurações</h2>
                        <form action="./processanome.php" method="post">
                            <label for="name">Nome:</label>
                            <input type="text" id="name" name="name" required>
                            <input type="submit" value="Salvar">
                        </form>
                        <form action="./processafoto.php" method="post" enctype="multipart/form-data">
                            <label for="profilePic">Foto de Perfil:</label>
                            <input type="file" id="profilePic" name="profilePic" required>
                            <input type="submit" value="Salvar" style="position: relative;top:-2px;">
                        </form>
                        <form action="./processasenha.php" method="post">
                            <label for="currentPassword">Senha Atual:</label>
                            <input type="password" id="currentPassword" name="currentPassword" required>
                            <label for="newPassword">Senha Nova:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <input type="submit" value="Salvar">
                        </form>
                    </div>
                </div>
            </div>

            <?php
            //Rrro ao tentar adicionar os amigos
            if (isset($_SESSION['erro_amigo_n_encontrado'])) {
                echo '<script>setTimeout(() => {alert("Usuário ou Id inválidos");}, 100);</script>';
                unset($_SESSION['erro_amigo_n_encontrado']);
            }
            if (isset($_SESSION['erro_mesmo_amigo'])) {
                echo '<script>setTimeout(() => {alert("Usúario já adicionado");}, 100);</script>';
                unset($_SESSION['erro_mesmo_amigo']);
            }
            if (isset($_SESSION['erro_senha_errada'])) {
                echo "<script>setTimeout(() => {alert('Senha Errada')}, 100)</script>";
                unset($_SESSION['erro_senha_errada']);
            }
            if (isset($_SESSION['erro_mesma_senha'])) {
                echo "<script>setTimeout(() => {alert('Você não pode redefinir a mesma senha')}, 100)</script>";
                unset($_SESSION['erro_mesma_senha']);
            }


            /* mantem os modais ativos ao pressionar o input*/
            if (isset($_SESSION['modal'])) {
                echo "<script>document.getElementById('" . $_SESSION['modal'] . "').style.display = 'block';</script>";
                unset($_SESSION['modal']);
            }
            ?>