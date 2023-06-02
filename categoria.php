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
    $categoriasQuery = 'SELECT * FROM categoria';
    $categoria = $conexao->query($categoriasQuery);

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
    <title>Categorias</title>
    <link rel="stylesheet" href="./css/tabelaG.css">
</head>

<body>
    <div class="tituloBot">        
        <a class="botTit" href="<?php echo $voltar; ?>">Página Inicial</a>
        <h3>CATEGORIAS</h3>
        <a href="cadastrocategoria.php" class="botTit">Nova Categoria</a>
    </div>

    <table>
        <div class="grupo">
                <div class="sub-grupo">idCategoria</div>
                <div class="sub-grupo">nome</div>

            </div>

                <?php 
                    while ($row = mysqli_fetch_array($categoria)) {
                        echo '<div class="grupo2">';
                        echo '<div class="sub-grupo2">'.$row['idCategoria']."</div>";
                        echo '<div class="sub-grupo2">'.$row['nomeCategoria']."</div>";
                        echo '<a href="categoriaedit.php?idCategoria='.$row['idCategoria'].'" class="sub-grupo2">Editar</a>
                        ';
                        echo '<div class="sub-grupo2"> <form method="post" action="delete.php">
                        <input type="hidden" name="idCategoria" value="'.$row['idCategoria'].'">
                        <input type="submit" value="Deletar" name="excluirCat" onClick="return confirm(\'Você tem certeza?\');">
                        </form>';
                        echo "</div>";
                        echo '</div>';
                    }
                ?>

    </table>
    <br>
    
</body>
</html>
