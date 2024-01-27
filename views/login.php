<header>
    <h1>Login</h1>
</header>
<section class="pagina">
    <br><br>
    <form action="./processalogin.php" method="post" class="form-login">
        <label for="nome-usuario">Nome de usuário:</label>
        <input type="text" name="usuario" id="nome-usuario"><br>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha"><br>
        <?php if (isset($_GET['erro'])) { ?>
            <p class="center">Usuário ou Senha inválidos</p>
        <?php }
        ?>
        <input type="submit" value="Entrar">
    </form>
</section>

<footer>
    <p>&copy; 2024 Chat. Todos os direitos reservados.</p>
</footer>