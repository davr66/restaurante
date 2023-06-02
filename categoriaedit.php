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

    if (!empty($_GET)) {
        $id = $_GET['idCategoria'];

        $categoriaQuery = "SELECT * FROM categoria WHERE idCategoria =".$id;
        $categoria = $conexao->query($categoriaQuery);
        $categoria = mysqli_fetch_array($categoria);
    }

    
    
    if (isset($_POST['update'])) 
    {
        //print_r($_POST['nome']);
        $id = $_POST['idCategoria'];
        $nomeCategoria = $_POST['nome'];

        $result = mysqli_query($conexao,"UPDATE categoria SET nomeCategoria = '$nomeCategoria' WHERE idCategoria =".$id);
        header("Location:categoria.php");
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
    <link rel="stylesheet" href="css/telaCategoria.css">
    <title>Cadastro de Categoria</title>
</head>
<body>
    <main>
        <section class="conteudo">
            <div class="conteudo-principal">
                <h4 class="apresentacao">Editar
                    <mark class="ORCHID">PRODUTO</mark>
                </h4>
    <form method="post" action="categoriaedit.php">
        <label for="nome" id="TextoC">Nome da Categoria:</label>
        <input type="text" value="<?php echo $categoria['nomeCategoria']; ?>" class="caixa-Registro" name="nome">
        <br>
        <input type="hidden" name="idCategoria" value="<?php echo $id;?>">
        <br>
        <span class="alinhamento">
        <input type="submit" class="botao-Env" name="update" value="Atualizar">     
        <button class="botao-Env" onclick="javascript:history.go(-1)">Voltar</button>  
        </span>
</form>
</div>
        </section>
</main>
<div class="fundoIMG"></div>
</body>
</html>