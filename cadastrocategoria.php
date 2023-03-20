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
    <link rel="stylesheet" href="css/telaCategoria.css">
    <title>Cadastro de Categoria</title>
</head>
<body>
    <main>
        <section class="conteudo">
            <div class="conteudo-principal">
                <h4 class="apresentacao">Cadastro de
                    <mark class="ORCHID">CATEGORIA</mark>
                </h4>
                <form method="post" action="cadastrocategoria.php">
                    <label for="nome" id="TextoC">Nome da Categoria</label>
                    <input type="text" name="nome" class="caixa-Registro">
                    <br>
                    <span class="alinhamento">
                    <input type="submit" name="submit" value="Enviar" class="botao-Env">
                    <button class="botao-Env">
                     <a href="<?php echo $voltar; ?>">Voltar</a>
                    </button>
                    </span> 
                    </form> 
            </div>
        </section>
</main>
<div class="fundoIMG"></div>
</body>
</html>
