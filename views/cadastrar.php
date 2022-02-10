

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locação de Imoveis</title>
    <link rel="stylesheet" href="../public/css/estilo.css">
</head>

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
    </div>
</body>

</html>