<?php 
session_start();
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    include_once('config.php');

    $contasQuery = 'SELECT idConta,u.nome AS garcom,dataAbertura,horaAbertura,p.nome AS produto,qtd,valorTotal FROM conta
    JOIN usuario as u
    USING (idUsuario)
    JOIN produto AS p
    USING (idProduto)';
    $contas = $conexao->query($contasQuery);

    if ($_SESSION['nivel']) 
    {
        $voltar="sistemagerente.php";    
    }
    else
    {
        $voltar="sistemagarcom.php";
    }

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/./tabelaC.css">
    <title>Contas</title>
</head>
<style>
    table,td,th {
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>

    <div class="tituloBot">
        <a class="botTit" href="<?php echo $voltar; ?>">Página Inicial</a>
        <h3>CONTAS</h3>
        <a href="cadastroconta.php" class="botTit">Nova Conta</a>
        
    </div>
            <div class="grupo">
                <div class="sub-grupo">idConta</div>
                <div class="sub-grupo">Garçom</div>
                <div class="sub-grupo">Data Abertura</div>
                <div class="sub-grupo">Hora Abertura</div>
                <div class="sub-grupo">Produto</div>
                <div class="sub-grupo">Quant.</div>
                <div class="sub-grupo">Valor Total</div>
            </div>
    
                <?php 
                    while ($row = mysqli_fetch_array($contas)) 
                    {
                        echo '<div class="grupo2">';
                        echo '<div class="sub-grupo2">'.$row['idConta']."</div>";
                        echo '<div class="sub-grupo2">'.$row['garcom']."</div>";
                        $data = date('d/m/Y', strtotime($row['dataAbertura']));
                        echo '<div class="sub-grupo2">'.$data."</div>";
                        echo '<div class="sub-grupo2">'.$row['horaAbertura']."</div>";
                        echo '<div class="sub-grupo2">'.$row['produto']."</div>";
                        echo '<div class="sub-grupo2">'.$row['qtd']."</div>";
                        $valorTotal = number_format($row['valorTotal'],2);
                        echo '<div class="sub-grupo2">R$'.str_replace(".",",",str_replace(",","",$valorTotal))."</div>";
                        echo '<a class="sub-grupo2" href="contasedit.php?idConta='.$row['idConta'].'">Editar</a>';
                        echo '<form method="post" action="delete.php" class="sub-grupo2">
                        <input type="hidden" name="idConta" value="'.$row['idConta'].'">
                        <input type="submit" value="Deletar" name="excluirConta" onClick="return confirm(\'Você tem certeza?\');">
                        </form>';
                        echo '</div>';
                    }
                ?>

</body>
</html>
