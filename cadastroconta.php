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

        $prod_qtd_query = 'SELECT quantEstoque FROM produto WHERE idProduto = '.$prod;
        $prod_qtd_query = $conexao->query($prod_qtd_query);
        $qtd_array = mysqli_fetch_array($prod_qtd_query);
        $qtdProd = $qtd_array[0];

        if ($qtd <= $qtdProd) {
            $valorTotal = $valor * $qtd;
            $result = mysqli_query($conexao,"INSERT INTO conta(dataAbertura,horaAbertura,idUsuario,idProduto,qtd,valorTotal) 
            VALUES ($data,$hora,$garcom,$prod,$qtd,$valorTotal)");

            $qtdEstoque = $qtdProd - $qtd;
            $prod_update = mysqli_query($conexao,"UPDATE produto SET quantEstoque = $qtdEstoque WHERE idProduto =".$prod);
            echo "<script>
                alert('Conta cadastrada!');
                window.location.href='contas.php';
                </script>";

        }else {
            echo "<script>
                alert('Não há produtos o suficiente para a ação requerida. Por favor, altere a quantidade');
                window.location.href='cadastroconta.php';
                </script>";
        }
    }

    if ($_SESSION['nivel']) 
    {
        $voltar="sistemagerente.php";    
    }
    else
    {
        $voltar="sistemagarcom.php";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/telaConta.css">
    <script defer src="js/main.js"></script>
    <title>Cadastro de Conta</title>
</head>
<body>
    <main class="conteudo">
        <section class="conteudo-principal">
            <h4 class="apresentacao">Cadastro de 
                <mark class="ORCHID">CONTAS</mark>
            </h4>
            <form method="post" action="cadastroconta.php">
                <label for="garcom" id="TextoC">Garçom:</label>
                <select name="garcom" class="caixa-Registro">
                    <?php 
                        while ($row = mysqli_fetch_array($garcom)) {
                            echo "<option value=".$row['idUsuario'].">".$row['nome']."</option>";
                        }
                    ?>
                </select>
                <br>
                <label for="produto" id="TextoC">Produto:</label>
                <select name="produto" class="caixa-Registro">
                    <?php
                        while ($row = mysqli_fetch_array($produtos)) 
                        {
                            echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                        }
                    ?>
                </select>
                <label for="qtd" id="TextoC">Quant.</label>
                <input type="number" onkeypress="return somenteNumeros(event)" name="qtd" class="caixa-Registro">
                <span class="alinhamento">
                <input type="submit" name="submit" value="Enviar" class="botao-Env">
                <button class="botao-Env" onclick="javascript:history.go(-1)">Voltar</button>
                </span>     
            </form>
        </section>
    </main>
    <div class="fundoIMG"></div>
</body>
</html>
