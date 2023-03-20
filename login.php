<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <section class="conteudo">
            <img src="img/LogoOrchid.png" alt="logoTIPO" class="logoT">
            <div class="conteudo-principal">
            <h4 class="apresentacao">Welcome <mark class="ORCHID">ORCHID</mark></h4>
    <form method="post" action="testeLogin.php">
            <label for="email">Email:</label>
            <input name="email" type="text" placeholder required class="caixa-Registro">
            <br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required class="caixa-Registro">
            <br>
            <input type="submit" name="submit" value="Enviar" class="botao-Env">
    </form>
            </div>
        </section>
    </main>
    <div class="fundoIMG"></div>
</body>
</html>