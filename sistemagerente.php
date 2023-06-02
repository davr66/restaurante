<?php 
session_start();
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true) || (($_SESSION['nivel']) != 1)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    $logado = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/telaSistemaGeral.css">
        <title>Restaurante - Lotus</title>
</head>
<body>
    <?php
        echo '<div class="titulo">Bem Vindo(a) '.$logado.'</div>';
    ?>
    <a href="cadastrogarcom.php">Cadastrar Garçom</a>
    
    <a href="cadastrocategoria.php">Nova Categoria</a>
    
    <a href="cadastroproduto.php">Novo Produto</a>
    
    <a href="cadastroconta.php">Nova Conta</a>
    
    <a href="produtos.php">Produtos</a>
    
    <a href="categoria.php">Categorias</a>
    
    <a href="garcom.php">Garçom</a>
    
    <a href="contas.php">Contas</a>
    
    <a href="relatorio.php">Relatório</a>
    
    <a href="sair.php">Sair</a>
</body>
</html>