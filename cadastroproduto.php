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
        $valor = str_replace(",",".",$valor);
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
    <link rel="stylesheet" href="css/telaProduto.css">
    <title>Cadastro de Produto</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <section class="conteudo-principal">
                <h4 class="apresentacao">Cadastro de 
                <mark class="ORCHID">PRODUTOS</mark>
                </h4>
                    <form method="post" action="cadastroproduto.php">
                        <label for="nome" id="TextoC">Nome:</label>
                            <input type="text" name="nome" class="caixa-Registro">
                            <br>
                            <label for="porcao" id="TextoC">Porção:</label>
                            <input type="text" name="porcao" class="caixa-Registro">
                            <br>
                            <label for="valor" id="TextoC">Valor:</label>
                            <input type="text" name="valor" class="caixa-Registro">
                            <br>
                            <label for="categoria" id="TextoC">Categoria</label>
                            <select name="categoria" class="caixa-Registro">
                                <?php 
                                    while ($row = mysqli_fetch_array($categoria)) {
                                        echo "<option value=".$row['idCategoria'].">".$row['nomeCategoria']."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                            <label for="quantEstoque" id="TextoC">Quantidade no Estoque</label>
                            <input type="text" name="quantEstoque" class="caixa-Registro">
                            <br>
                            <span class="alinhamento">
                            <input type="submit" name="submit" value="Enviar" class="botao-Env"> 
                            <button class="botao-Env">
                            <a href="<?php echo $voltar; ?>">Voltar</a>
                            </button>
                            </span>
                    </form>
            </section>
        </div>
</main> 
<div class="fundoIMG"></div>
</body>
</html>