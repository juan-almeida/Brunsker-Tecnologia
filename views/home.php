<body>
    <div id="corpo-login">
        <h1>Faça seu login</h1>
        <form action="../Controllers/ControllerLogin.php" method="post">
            <input type="hidden" name="action" value="login">
            <input type="email" name="email" placeholder="Digite o e-mail cadastrado" required>
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="Acessar">
            <a href="views/cadastrar.php">Ainda não é cadastrado?<strong> Cadastre-se</strong></a>
        </form>
    </div>
</body>

