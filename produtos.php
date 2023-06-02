<?php 
session_start();
    //print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true) ) 
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
        $voltar="sistemagarcom.php";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/tabela.css">
    <title>Produtos</title>
</head>

<body>
    
    <div class="tituloBot">
        <a class="botTit" href="<?php echo $voltar; ?>">Página Inicial</a>
        <h3>PRODUTOS</h3>
        <a href="cadastroproduto.php" class="botTit">Novo Produto</a>
    </div>
    
  
        <div class="grupo">
            <div class="sub-grupo">idProd.</div>
            <div class="sub-grupo">Nome</div>
            <div class="sub-grupo">Valor</div>
            <div class="sub-grupo">Categoria</div>
            <div class="sub-grupo">Quant. em Estoque</div> 
            </div>

                <?php 
                    while ($row = mysqli_fetch_array($produtos)) {
                        echo '<div class="grupo2">';
                        echo '<div class="sub-grupo2">'.$row['idProduto']."</div>";
                        echo '<div class="sub-grupo2">'.$row['nome']."</div>";
                        echo '<div class="sub-grupo2">R$'.str_replace(".",",",$row['valor'])."</div>";
                        echo '<div class="sub-grupo2">'.$row['nomeCategoria']."</div>";
                        echo '<div class="sub-grupo2">'.$row['quantEstoque']."</div>";
                        echo '
                        <a class="sub-grupo2"href="produtosedit.php?idProduto=' .$row['idProduto'].'">Editar</a>';
                        
                        echo '<div class="sub-grupo2"> <form method="post" action="delete.php">
                        <input type="hidden" name="idProduto" value="'.$row['idProduto'].'">
                        <input type="submit" value="Deletar" name="excluirProd" onClick="return confirm(\'Você tem certeza?\');">
                        </form>';
                        echo "</div>";
                        echo '</div>';
                    }
                ?>
    </table>

</body>
</html>
<?php 
    if (isset($_POST['excluir'])) {
        $id = $_POST['idProduto'];

        $deleteProdutoQuery = 'DELETE FROM produto WHERE idProduto ='.$id;
        $conexao->query($deleteProdutoQuery);
        
        
        header("Location:produtos.php");
    }
?>