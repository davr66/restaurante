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

    $contasQuery = 'SELECT idConta,u.nome,dataAbertura,horaAbertura,p1.nome,qtdProd1,p2.nome,qtdProd2,p3.nome,qtdProd3,valorTotal FROM conta
    JOIN usuario as u
    USING (idUsuario)
    JOIN produto AS p1
    ON p1.idProduto = idProduto1
    JOIN produto AS p2
    ON p2.idProduto = idProduto2
    JOIN produto AS p3
    ON p3.idProduto = idProduto3;';
    $contas = $conexao->query($contasQuery);

    if ($_SESSION['nivel']) 
    {
        $voltar="sistemagerente.php";    
    }
    else
    {
        $voltar="sitemagarcom.php";
    }

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garçons</title>
</head>
<style>
    table,td,th {
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h3>Contas</h3>
    <br>
    <a href="cadastrogarcom.php">Nova Conta</a>
    <table>
        <thead>
            <tr>
                <th>idConta</th>
                <th>Garçom</th>
                <th>Data Abertura</th>
                <th>Hora Abertura</th>
                <th>Produto 1</th>
                <th>Quant.</th>
                <th>Produto 2</th>
                <th>Quant.</th>
                <th>Produto 3</th>
                <th>Quant.</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    while ($row = mysqli_fetch_array($contas)) {
                        echo "<tr>";
                        echo "<td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        echo "<td>".$row[2]."</td>";
                        echo "<td>".$row[3]."</td>";
                        echo "<td>".$row[4]."</td>";
                        echo "<td>".$row[5]."</td>";
                        echo "<td>".$row[6]."</td>";
                        echo "<td>".$row[7]."</td>";
                        echo "<td>".$row[8]."</td>";
                        echo "<td>".$row[9]."</td>";
                        echo "<td>".$row[10]."</td>";
                        echo "</tr>";
                    }
                ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>