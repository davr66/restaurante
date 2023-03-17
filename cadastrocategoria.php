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
    
    if (isset($_POST['submit'])) 
    {
        //print_r($_POST['nome']);
        $nomeCategoria = $_POST['nome'];

        $result = mysqli_query($conexao,"INSERT INTO categoria(nomeCategoria) 
        VALUES ('$nomeCategoria')");
                
        echo "<script>alert('Categoria cadastrada!')</script>";
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
    <title>Cadastro de Categoria</title>
</head>
<body>
    <form method="post" action="cadastrocategoria.php">
        <label for="nome">Nome da Categoria:</label>
        <input type="text" name="nome">
        <br>
        <input type="submit" name="submit" value="Enviar">     
</form> 
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>
