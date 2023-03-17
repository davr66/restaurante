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
        $voltar="sitemagarcom.php";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categoria</title>
</head>
<body>
    <form method="post" action="categoriaedit.php">
        <label for="nome">Nome da Categoria:</label>
        <input type="text" value="<?php echo $categoria['nomeCategoria']; ?>" name="nome">
        <br>
        <input type="hidden" name="idCategoria" value="<?php echo $id;?>">
        <br>
        <input type="submit" name="update" value="Atualizar">     
</form> 
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>