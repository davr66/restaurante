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
        $voltar="sitemagarcom.php";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<style>
    table,td,th {
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h3>Produtos</h3>
    <br>
    <a href="cadastroproduto.php">Nova Categoria</a>
    <table>
        <thead>
            <tr>
                <th>idCategoria</th>
                <th>nome</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    while ($row = mysqli_fetch_array($categoria)) {
                        echo "<tr>";
                        echo "<td>".$row['idCategoria']."</td>";
                        echo "<td>".$row['nomeCategoria']."</td>";
                        echo '<th>
                        <a href="categoriaedit.php?idCategoria='.$row['idCategoria'].'">Editar</a>
                        </th>';
                        echo '<th> <form method="post" action="categoria.php">
                        <input type="hidden" name="idCategoria" value="'.$row['idCategoria'].'">
                        <input type="submit" id="excluir" value="Deletar" name="excluir"></form>';
                        echo "</tr>";
                    }
                ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>
<?php 
    if (isset($_POST['excluir'])) {
        $id = $_POST['idCategoria'];

        $deleteCategoriaQuery = 'DELETE FROM categoria WHERE idCategoria ='.$id;
        $conexao->query($deleteCategoriaQuery);
        
        
        header('Location:categoria.php');
    }
?>