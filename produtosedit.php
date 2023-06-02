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

    if (!empty($_GET)) {
        $idProd = $_GET['idProduto'];

        $produtosQuery = 'SELECT idProduto,nome,porcao,valor,idCategoria,c.nomeCategoria,quantEstoque
        FROM produto
        JOIN categoria AS c
        USING (idCategoria)
        WHERE idProduto = '.$idProd;
        $produtos = $conexao->query($produtosQuery);
        $produtos = mysqli_fetch_array($produtos);
    }

    $logado = $_SESSION['email'];
    $categoriaQuery = 'SELECT * FROM categoria';
    $categoria = $conexao->query($categoriaQuery);
    
    if (isset($_POST['update'])) 
    {   
        //print_r($_POST['nome']);
        //print_r('<br>');
        //print_r($_POST['porcao']);
        //print_r('<br>');
        //print_r($_POST['valor']);
        //print_r('<br>');
        //print_r($_POST['categoria']);
        //print_r('<br>');
        //print_r($_POST['quantEstoque']);

        $nomeProd = $_POST['nome'];
        $porcao = $_POST['porcao'];
        $valor = $_POST['valor'];
        $idCategoria = $_POST['categoria'];
        $quantEstoque = $_POST['quantEstoque'];
        $idProd = $_POST['idProduto'];

        $result = mysqli_query($conexao,"UPDATE produto SET nome = '$nomeProd',porcao = $porcao,
        valor = $valor,idCategoria = $idCategoria,quantEstoque = $quantEstoque
        WHERE idProduto =".$idProd);
                
        echo "<script>alert('Produto adicionado!')</script>";
        header("Location:produtos.php");
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
    <link rel="stylesheet" href="css/telaProduto.css">
    <title>Edição de Produto</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <section class="conteudo-principal">
            <h4 class="apresentacao">Edição de 
                <mark class="ORCHID">PRODUTOS</mark>
                </h4>
    <form method="post" action="produtosedit.php">
        <label for="nome" id="TextoC">Nome:</label>
        <input type="text" class="caixa-Registro" value ="<?php echo $produtos['nome'];?>" name="nome">
        <br>
        <label for="porcao" id="TextoC">Porção:</label>
        <input type="text" class="caixa-Registro" value="<?php echo $produtos['porcao']; ?>" name="porcao">
        <br>
        <label for="valor" id="TextoC">Valor:</label>
        <input type="text" class="caixa-Registro" value="<?php echo $produtos['valor']; ?>" name="valor">
        <br>
        <label for="categoria" id="TextoC">Categoria</label>
        <select name="categoria" class="caixa-Registro">
            <option value="<?php echo $produtos['idCategoria']?>">
            <?php echo $produtos['nomeCategoria']?></option>
            <?php 
                while ($row = mysqli_fetch_array($categoria)) {
                    echo "<option value=".$row['idCategoria'].">".$row['nomeCategoria']."</option>";
                }
            ?>
        </select>
        <br>
        <label for="quantEstoque" id="TextoC">Quantidade no Estoque</label>
        <input type="number" class="caixa-Registro" value="<?php echo $produtos['quantEstoque'];?>" name="quantEstoque">
        <br>
        <input type="hidden" name="idProduto" value="<?php echo $idProd;?>">
        <br>
        <span class="alinhamento">
        <input type="submit" class="botao-Env" name="update" value="Atualizar"> 
        <button class="botao-Env" onclick="javascript:history.go(-1)">Voltar</button>      
        </span>
</form> 
</section>
        </div>
</main> 
<div class="fundoIMG"></div>
</body>
</html>