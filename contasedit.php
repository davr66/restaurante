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
    if (!empty($_GET)) {
        $idConta = $_GET['idConta'];  
        $contasQuery = 'SELECT dataAbertura,horaAbertura,idUsuario,u.nome AS nomeGarcom,idProduto,p.nome AS nomeProd,qtd,valorTotal FROM conta
        JOIN usuario AS u
        USING (idUsuario)
        JOIN produto AS p
        USING (idProduto)
        WHERE idConta ='.$idConta;

    $contas = $conexao->query($contasQuery);
    $contas = mysqli_fetch_array($contas);
    }

    $garcomQuery = 'SELECT * FROM usuario WHERE nivel = 0';
    $garcom = $conexao->query($garcomQuery);

    $produtosQuery = 'SELECT * FROM produto';
    $produtos = $conexao->query($produtosQuery);

    if (isset($_POST['update'])) {
        $idConta = $_POST['idConta'];
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

        $result = mysqli_query($conexao,"UPDATE conta SET dataAbertura = $data,
        horaAbertura = $hora,idUsuario = $garcom,
        idProduto = $prod,qtd = $qtd,valorTotal = $valorTotal
        WHERE idConta=".$idConta);
        header('Location:contas.php');


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
    <title>Editar Conta</title>
</head>
<body>
    <main class="conteudo">
        <section class="conteudo-principal">
            <h4 class="apresentacao">Editar 
                <mark class="ORCHID">CONTA</mark>
            </h4>
    <form method="post" action="contasedit.php">
        <label for="garcom" id="TextoC">Garçom:</label>
        <select name="garcom" class="caixa-Registro">
            <option value = "<?php echo $contas['idUsuario']; ?>" ><?php echo $contas['nomeGarcom']?></option>
            <?php 
                while ($row = mysqli_fetch_array($garcom)) {
                    echo "<option value=".$row['idUsuario'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <br>
        <label for="produto" id="TextoC">Produto:</label>
        <select name="produto" class="caixa-Registro">
            <option value="<?php echo $contas['idProduto']?>"><?php echo $contas['nomeProd'] ?></option>
            <?php
                while ($row = mysqli_fetch_array($produtos)) 
                {
                    echo "<option value=".$row['idProduto'].">".$row['nome']."</option>";
                }
            ?>
        </select>
        <label for="qtd" id="TextoC">Quant.</label>
        <input type="number" class="caixa-Registro" value="<?php echo $contas['qtd']?>" name="qtd">
        <br>
        <input type="hidden" class="caixa-Registro" name="idConta" value="<?php echo $idConta ?>">
        <br>
        <span class="alinhamento">
        <input type="submit" class="botao-Env" name="update" value="Atualizar">  
        <button class="botao-Env" onclick="javascript:history.go(-1)">Voltar</button>   
        </span>  
</form> 
</section>
    </main>
    <div class="fundoIMG"></div>
</body>
</html>
