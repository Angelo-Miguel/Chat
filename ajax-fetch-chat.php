<?php
include 'db.php';
if ($amigo_selecionado != "0") {
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