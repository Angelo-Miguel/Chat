<header>
    <h1>Login</h1>
</header>
<div class="content-login">
    <form action="assets/php/processalogin.php" method="post" class="form-login">
        <label for="nome-usuario">Nome de usuário:</label>
        <input type="text" name="usuario" id="nome-usuario">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">
        <a href="?cadastro=cadastro" class="center">Cadastro</a>
        <input type="submit" value="Entrar">
        <!-- Erros ao tentar logar -->
        <?php if (isset($_GET['erro_login'])) { ?>
            <p class="center">Usuário ou Senha inválidos</p>
        <?php }
        ?>
    </form>
</div>