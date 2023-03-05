<?php 
session_start();
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true) || (($_SESSION['nivel']) != 1)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    $logado = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Lotus</title>
</head>
<body>
    <?php
        echo "<h3>Bem Vindo(a) <u>$logado</u></h3>";
    ?>
    <a href="cadastrogarcom.php">Cadastrar Garçom</a>
    <br>
    <a href="cadastrocategoria.php">Nova Categoria</a>
    <br>
    <a href="cadastroproduto.php">Novo Produto</a>
    <br>
    <a href="cadastroconta.php">Nova Conta</a>
    <br><br><br>
    <a href="produtos.php">Produtos</a>
    <br>
    <a href="garcom.php">Garçom</a>
    <br>
    <a href="contas.php">Contas</a>
    <br><br><br>
    <a href="sair.php">Sair</a>
</body>
</html>