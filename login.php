<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="testeLogin.php">
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" required>
            <br>
            <input type="submit" name="submit" value="Enviar" >
    </form>
    <a href="home.php">Voltar</a>
</body>
</html>