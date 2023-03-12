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
    <a href="cadastroconta.php">Nova Conta</a>
    <table>
        <thead>
            <tr>
                <th>idConta</th>
                <th>Garçom</th>
                <th>Data Abertura</th>
                <th>Hora Abertura</th>
                <th>Produto</th>
                <th>Quant.</th>
                <th>Valor Total</th>
                <th>...</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    while ($row = mysqli_fetch_array($contas)) 
                    {
                        echo "<th>".$row['idConta']."</th>";
                        echo "<th>".$row['garcom']."</th>";
                        echo "<th>".$row['dataAbertura']."</th>";
                        echo "<th>".$row['horaAbertura']."</th>";
                        echo "<th>".$row['produto']."</th>";
                        echo "<th>".$row['qtd']."</th>";
                        echo "<th>".$row['valorTotal']."</th>";
                        echo '<th> <form method="post">';
                        echo '<input type="hidden" name="idConta" value="'.$row['idConta'].'">';
                        echo '<button type="submit" onclick="<script>alert(`Você tem certeza?`)</script>">';
                        echo '<input type="hidden" name="excluir">';
                        echo 'Deletar</button></form>';
                    }
                ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>