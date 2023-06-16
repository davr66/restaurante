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

    $garcomQuery = 'SELECT * FROM usuario WHERE nivel = 0';
    $garcom = $conexao->query($garcomQuery);

    if ($_SESSION['nivel']) 
    {
        $voltar="sistemagerente.php";    
    }
    else
    {
        $voltar="sistemagarcom.php";
    }

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/tabelaGarç.css">
    <title>Garçons</title>
</head>

<body>
    <div class="tituloBot">
    <a class="botTit" href="<?php echo $voltar; ?>">Página Inicial</a>
        <h3>GARÇONS</h3>
        <a href="cadastrogarcom.php" class="botTit">Novo Garçom</a>
    </div>
           
                <div class="grupo">
                    <div class="sub-grupo">Nome</div>
                    <div class="sub-grupo">Telefone</div>
                    <div class="sub-grupo">Endereço</div>
                    <div class="sub-grupo">CPF</div>
                    <div class="sub-grupo">RG</div>
                    <div class="sub-grupo">Email</div>
                </div>
            
        
                <?php 
                    while ($row = mysqli_fetch_array($garcom)) {
                        echo '<div class="grupo2">';
                        echo '<div class="sub-grupo2">'.$row['nome']."</div>";
                        echo '<div class="sub-grupo2">'.$row['telefone']."</div>";
                        echo '<div class="sub-grupo2">'.$row['endereco']."</div>";
                        echo '<div class="sub-grupo2">'.$row['cpf']."</div>";
                        echo '<div class="sub-grupo2">'.$row['rg']."</div>";
                        echo '<div class="sub-grupo2">'.$row['email']."</div>";
                        echo ' <a class="sub-grupo2" href="garcomedit.php?idUsuario='.$row['idUsuario'].'">Editar</a>';
                        echo '<form method="post" action="delete.php" class="sub-grupo2">
                        <input type="hidden" name="idUsuario" value="'.$row['idUsuario'].'">
                        <input type="submit" value="Deletar" name="excluirUser" onClick="return confirm(\'Você tem certeza?\');">
                        </form>';
                        echo "</div>";
                        echo "</div>";
                    }
                ?>

      
</body>
</html>
