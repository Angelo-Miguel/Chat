    <div id="chat">
        <div id="sid-menu" class="menu-lateral">
            <div class="sid-title">
                <span class="close-sid"></span>
                <h3>Recentes</h3>
                <span class="close close-sid" onclick="closeMenu()">&times;</span>
            </div>
            <span id="recentes">
                <!-- Exibi as recentes conversas entre as amizades via AJAX -->
            </span>
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
                    <div class="info-perfil">
                        <span class="nome-perfil"><?= $_SESSION['usuario'] ?></span>
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
            if ($amigo_selecionado != 0) {
            ?>
                <section>
                    <div class="content-header-chat" id="profile">
                        <!-- Perfil do amigo será carregado aqui via ajax -->
                    </div>
                    <div class="container-chat">
                        <div class="mensagens" id="msg">
                            <!-- Mensagens serão adicionadas via ajax -->
                        </div>
                        <div class="scroll-down" id="scrollDown" onclick="msgScrollHeight()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                            </svg>
                        </div>
                        <form class="escrever" onsubmit="sendMessage(); return false">
                            <input type="text" name="text" id="text" class="msg" required minlength="1">
                            <input type="submit" class="msgenviar" value="Enviar">
                        </form>
                    </div>
                </section>
            <?php
            } else {
            ?>
                <!-- Arumar isso depois | tela quando nao tem nenhum amigo selecionado-->
                <div style="height:82.5vh; display: flex; justify-content: center; align-items: center;">
                    <div class="balao">
                        <div class="msg">
                            <span class="frase">
                                <div style="text-align: center;">Bem-vindo ao nosso chat!</div>Selecione um usuário para começar a conversa.
                            </span>
                            <div class="autor"></div>
                        </div>
                    </div>
                </div>
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
                                    echo "<td><a href='#' onclick='changeUserChat(" . $linha['id_usuarios'] . "); return false;'><div class='nome'><img class='img-perfil' src='data:image;base64," . base64_encode($conteudoArquivo) . "' alt='foto de perfil do " . $linha['usuario'] . "'><p>" . $linha['usuario'] . "</p></div></a></td>";
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

                    <div class="header">
                        <h1>Configurações</h1>
                        <span class="close" onclick="closeModal('modalConfig')">&times;</span>
                    </div>
                    <div class="section-config">
                        <div>
                            <h3>Perfil</h3>
                            <label for="avatar">Avatar:</label>
                            <img src="./assets/img/nouser.png" class="img-perfil" alt="Avatar" style="width: 100px; height:100px">
                            <button>Trocar</button>
                            <label for="nomeExibido">Nome Exibido:</label>
                            <input type="text" id="nomeExibido" value="Sinjas">
                            <label for="status">Status:</label>
                            <input type="text" id="status" value="Olá, agora eu estou usando o chat">
                        </div>
                        <div>
                            <h3>Aparência</h3>
                            <label for="tema">Tema:</label>
                            <label class="switch">
                                <input type="checkbox" id="themeSwitch">
                                <span class="slider"></span>
                            </label>
                            <label for="tamanhoFonte">Tamanho da fonte:</label>
                            <button>Pequena</button>
                            <button>Média</button>
                            <button>Grande</button>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>

            <?php
            /* TRATAMENTO DE ERROS */
            /* Erro modal amgios */
            if (isset($_SESSION['erro_amigo_n_encontrado'])) {
                echo '<script>setTimeout(() => {alert("Usuário ou Id inválidos");}, 100);</script>';
                unset($_SESSION['erro_amigo_n_encontrado']);
            }
            if (isset($_SESSION['erro_mesmo_amigo'])) {
                echo '<script>setTimeout(() => {alert("Usúario já adicionado");}, 100);</script>';
                unset($_SESSION['erro_mesmo_amigo']);
            }
            /* Erro modal configuração */
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