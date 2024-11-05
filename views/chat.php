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
                <a onclick="openModal('modalFriends')">Amigos</a>
                <a onclick="openModal('modalConfig')">Configurações</a>
                <a href="assets/php/logout.php">Sair</a>
            </nav>
            <div id="conteudoChat">
                <!-- conteudo do chat será adicionado via ajax -->
            </div>

            <!-- Modal da aba Amigos -->
            <div id="modalFriends" class="modal">
                <div class="modal-content">
                    <div class="header">
                        <h1>Amigos</h1>
                        <span class="close" onclick="closeModal('modalFriends')">&times;</span>
                    </div>
                    <div class="section-friends">
                        <div class="friends-list">
                            <h2>Lista de Amigos</h2>
                            <div class="scrollTable">
                                <table>
                                    <!-- css inline deixa o thead fixada no topo ao "scrollar" para baixo -->
                                    <thead style="position: sticky;top:0">
                                        <tr>
                                            <th colspan="2">Nome</th>
                                            <th>Excluir</th>
                                            <th>Favoritar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($linha = mysqli_fetch_array($consulta_amigos)) {
                                            $conteudoArquivo = $linha['imagem'];
                                        ?>
                                            <tr class="friend">
                                                <td class="img" style="width: 30px">
                                                    <a href="#" onclick="changeUserChat('<?= $linha['id_usuarios'] ?>')">
                                                        <img class="img-perfil" src="data:image;base64,<?= base64_encode($conteudoArquivo) ?>" alt="foto de perfil do <?= $linha['usuario'] ?>">
                                                    </a>
                                                </td>
                                                <td class="name">
                                                    <a href="#" onclick="changeUserChat('<?= $linha['id_usuarios'] ?>')">
                                                        <p><?= $linha["usuario"] ?></p>
                                                    </a>
                                                </td>
                                                <td class="trash">
                                                    <a href="./assets/php/processadeletaamigo.php?id_deletar=<?= $linha['id_usuarios'] ?>">
                                                        <i class="fa-solid fa-trash" style="color: #000;"></i>
                                                    </a>
                                                </td>
                                                <td class="fav">
                                                    <input type="checkbox" id="favCheckbox_<?= $linha['id_usuarios'] ?>" data-id="<?= $linha['id_usuarios'] ?>" class="favCheckbox" <?= $linha['favorito'] ? 'checked' : '' ?> onchange="toggleFavorite(<?= $linha['id_usuarios'] ?>, this.checked)">
                                                    <label for="favCheckbox_<?= $linha['id_usuarios'] ?>" class="label-fav">
                                                        <i class="fa-regular fa-star unchecked-icon"></i>
                                                        <i class="fa-solid fa-star checked-icon"></i>
                                                    </label>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="add-friend">
                            <h2>Adicionar Amigos</h2>
                            <form action="./assets/php/processaamigos.php" method="post">
                                <input type="text" placeholder="Nome do Usuário" name="usuario">
                                <input type="text" placeholder="ID" name="id">
                                <input type="submit" value="Adicionar">
                            </form>
                        </div>
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
                        <div>
                            <h3>Segurança</h3>
                            <form action="../assets/php/processaemail">
                                <label for="email">Seu novo Email:</label>
                                <input type="email" id="email" name="email" required>
                                <input type="submit" value="Trocar Email">
                            </form>
                            <form action="../assets/php/processasenha.php" method="post">
                                <label for="currentPassword">Senha Atual:</label>
                                <input type="password" id="currentPassword" name="currentPassword" required>
                                <label for="newPassword">Senha Nova:</label>
                                <input type="password" id="newPassword" name="newPassword" required>
                                <input type="submit" value="Salvar">
                            </form>
                            <form action="../assets/php/processaexclusao">
                                <input type="submit" value="Excluir conta" style="background-color: red;">
                            </form>
                            <form action="../assets/php/processalimpaconversa">
                                <input type="submit" value="Limpar as conversas" style="background-color: red;">
                            </form>
                        </div>
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