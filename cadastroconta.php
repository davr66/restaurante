<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    include_once('config.php');
    $garcomQuery = 'SELECT * FROM usuario WHERE nivel = 0';
    $garcom = $conexao->query($garcomQuery);

    $produtosQuery = 'SELECT * FROM produto';
    $produtos = $conexao->query($produtosQuery);

    if (isset($_POST['submit'])) {
        $garcom = $_POST['garcom'];
        $prod = $_POST['produto'];
        $data = date('Ymd');
        $hora = date('His');
        $qtd = $_POST['qtd'];

        $prod_query = 'SELECT valor FROM produto WHERE idProduto = '.$prod;
        $prod_query = $conexao->query($prod_query);
        $prod_array = mysqli_fetch_array($prod_query);
        $valor = $prod_array[0];

        $valorTotal = $valor * $qtd;

        $result = mysqli_query($conexao,"INSERT INTO conta(dataAbertura,horaAbertura,idUsuario,idProduto,qtd,valorTotal) 
        VALUES ($data,$hora,$garcom,$prod,$qtd,$valorTotal)");
        header('Location:contas.php');


    }

    if ($_SESSION['nivel']) 
    {
        $voltar="sistemagerente.php";    
    }
    else
    {
        $voltar="sitemagarcom.php";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Conta</title>
</head>
<body>
    <form method="post" action="cadastroconta.php">
        <label for="garcom">Garçom:</label>
        <select name="garcom">
            <?php 
                while ($row = mysqli_fetch_array($garcom)) {
                    echo "<option value=".$row['idUsuario'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <br>
        <label for="produto">Produto:</label>
        <select name="produto">
            <?php
                while ($row = mysqli_fetch_array($produtos)) 
                {
                    echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <label for="qtd">Quant.</label>
        <input type="number" name="qtd">
        <br>
        <br>
        <input type="submit" name="submit" value="Enviar">     
</form> 
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>
