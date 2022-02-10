<?php

include 'header.php';

 ?>
<body>
    <div id="corpo-cad">
        <h1>Cadastre-se</h1>
        <form action="../Controllers/ControllerLogin.php" method="post">
            <input type="hidden" name="action" value="register">
            <input type="text" name="nome" placeholder="Nome Completo">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="confirma_senha" placeholder="Confirmar Senha">
            <input type="submit" value="Cadastrar">

        </form>
        <?php

        if (isset($_SESSION['return'])) {
        ?>
            <div class="<?= $_SESSION['return']['class'] ?>">
                <?=
                $_SESSION['return']['msg'];
                ?>

            </div>

        <?php
            unset($_SESSION['return']);
        }
        ?>

    </div>
</body>

</html>