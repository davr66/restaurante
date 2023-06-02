<?php 
session_start();
//print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true )) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    include_once('config.php');

    $logado = $_SESSION['email'];
    
    $produtosQuery = "SELECT * FROM produto";
    $produto = $conexao->query($produtosQuery);
    $numProdutos = mysqli_num_rows($produto);

    $valorFevQuery = "SELECT sum(valorTotal) FROM conta
    WHERE dataAbertura BETWEEN '2023-01-31' AND '2023-03-01'";
    $valorFev = $conexao->query($valorFevQuery);
    $valorFevArray = mysqli_fetch_array($valorFev);
    $valorFev = $valorFevArray[0];
    $valorFev = str_replace(".",",",str_replace(",","",number_format($valorFev,2)));

    if ($valorFev == null) {
        $msg = 'Não há vendas no mês de Fevereiro';
    }
    else
    {
        $msg = 'Valor recebido no mês de Fevereiro:<div class="linha">R$'. $valorFev."</div>";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/telaRelatorio.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
</head>
<body>
    <h3 class="titulo">Relatório</h3>
    <div class="conteudo-Geral">
        <p class="sub-titulo">Produtos Cadastrados: <?php echo '<div class="linha">'.$numProdutos.'</div>'; ?></p>
        <p class="sub-titulo1"><?php echo $msg;?></p>
        <button class="botao-" onclick="javascript:history.go(-1)">Voltar</button>
    </div>
</body>
</html>