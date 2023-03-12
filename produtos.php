<?php 
session_start();
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true) || (($_SESSION['nivel']) != 1)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    include_once('config.php');

    $logado = $_SESSION['email'];
    $produtosQuery = 'SELECT idProduto,nome,valor,c.nomeCategoria,quantEstoque FROM produto
    JOIN categoria AS c
    USING(idCategoria)';
    $produtos = $conexao->query($produtosQuery);

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
    <title>Produtos</title>
</head>
<style>
    table,td,th {
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h3>Produtos</h3>
    <br>
    <a href="cadastroproduto.php">Novo Produto</a>
    <table>
        <thead>
            <tr>
                <th>idProd.</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Quant. em Estoque</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    while ($row = mysqli_fetch_array($produtos)) {
                        echo "<tr>";
                        echo "<td>".$row['idProduto']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td>".$row['valor']."</td>";
                        echo "<td>".$row['nomeCategoria']."</td>";
                        echo "<td>".$row['quantEstoque']."</td>";
                        echo '<th>
                        <a href="produtosedit.php?idProduto='.$row['idProduto'].'">Editar</a>
                        </th>';
                        echo '<th> <form method="post" action="produtos.php">
                        <input type="hidden" name="idProduto" value="'.$row['idProduto'].'">
                        <input type="submit" id="excluir" value="Deletar" name="excluir"></form>';
                        echo "</tr>";
                    }
                ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>
<?php 
    if (isset($_POST['excluir'])) {
        $id = $_POST['idProduto'];

        $deleteProdutoQuery = 'DELETE FROM produto WHERE idProduto ='.$id;
        $conexao->query($deleteProdutoQuery);
        
        
        header('Location:produtos.php');
    }
?>