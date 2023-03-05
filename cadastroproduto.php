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
    $categoriaQuery = 'SELECT * FROM categoria';
    $categoria = $conexao->query($categoriaQuery);
    
    if (isset($_POST['submit'])) 
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

        $result = mysqli_query($conexao,"INSERT INTO produto(nome,porcao,valor,idCategoria,quantEstoque) 
                VALUES ('$nomeProd',$porcao,$valor,$idCategoria,$quantEstoque)");
                
        echo "<script>alert('Produto adicionado!')</script>";
        header("Location:produtos.php");
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
    <title>Cadastro de Produto</title>
</head>
<body>
    <form method="post" action="cadastroproduto.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome">
        <br>
        <label for="porcao">Porção:</label>
        <input type="text" name="porcao">
        <br>
        <label for="valor">Valor:</label>
        <input type="text" name="valor">
        <br>
        <label for="categoria">Categoria</label>
        <select name="categoria">
            <?php 
                while ($row = mysqli_fetch_array($categoria)) {
                    echo "<option value=".$row['idCategoria'].">".$row['nomeCategoria']."</option>";
                }
            ?>
        </select>
        <br>
        <label for="quantEstoque">Quantidade no Estoque</label>
        <input type="text" name="quantEstoque">
        <br>
        <input type="submit" name="submit" value="Enviar">     
</form> 
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>