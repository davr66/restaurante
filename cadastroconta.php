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
        $prod1 = $_POST['produto1'];
        $prod2 = $_POST['produto2'];
        $prod3 = $_POST['produto3'];
        $data = date('Ymd');
        $hora = date('His');
        $qtd1 = $_POST['qtd1'];
        $qtd2 = $_POST['qtd2'];
        $qtd3 = $_POST['qtd3'];

        $prod_1_query = 'SELECT valor FROM produto WHERE idProduto = '.$prod1;
        $prod_1_query = $conexao->query($prod_1_query);
        $prod1_array = mysqli_fetch_array($prod_1_query);
        $valor1 = $prod1_array[0];

        if(!empty($prod2))
        {
        $prod_2_query = 'SELECT valor FROM produto WHERE idProduto = '.$prod2;
        $prod_2_query = $conexao->query($prod_2_query);
        $prod2_array = mysqli_fetch_array($prod_2_query);
        $valor2 = $prod2_array[0];
        }

        if(!empty($prod3))
        {
        $prod_3_query = 'SELECT valor FROM produto WHERE idProduto = '.$prod3;
        $prod_3_query = $conexao->query($prod_3_query);
        $prod3_array = mysqli_fetch_array($prod_3_query);
        $valor3 = $prod3_array[0];
        }

        $valorTotal = $valor1 * $qtd1 + $valor2 * $qtd2 + $valor3 * $qtd3;

        $result = mysqli_query($conexao,"INSERT INTO conta(dataAbertura,horaAbertura,idUsuario,idProduto1,qtdProd1,
        idProduto2,qtdProd2,idProduto3,qtdProd3,valorTotal) 
        VALUES ($data,$hora,$garcom,$prod1,$qtd1,$prod2,$qtd2,$prod3,$qtd3,$valorTotal)");
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
        <label for="produto1">Produto 1:</label>
        <select name="produto1">
            <?php
                while ($row = mysqli_fetch_array($produtos)) 
                {
                    echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                }
                $produtos = reset($produtos);

            ?>
        </select>
        <label for="qtd1">Quant.</label>
        <input type="number" name="qtd1">
        <br>
        <label for="produto2">Produto 2:</label>
        <select name="produto2">
            <option value="">Nenhum</option>
            <?php 
            $produtosQuery = 'SELECT * FROM produto';
            $produtos = $conexao->query($produtosQuery);
                while ($row = mysqli_fetch_array($produtos)) 
                {
                    echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <label for="qtd2">Quant.</label>
        <input type="number" name="qtd2">
        <br>
        <label for="produto3">Produto 3:</label>
        <select name="produto3">
            <option value="">Nenhum</option>
            <?php 
            $produtosQuery = 'SELECT * FROM produto';
            $produtos = $conexao->query($produtosQuery);
                while ($row = mysqli_fetch_array($produtos)) 
                {
                    echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <label for="qtd3">Quant.</label>
        <input type="number" name="qtd3">
        <br>
        <br>
        <input type="submit" name="submit" value="Enviar">     
</form> 
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>
