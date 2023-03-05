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
        $voltar="sitemagarcom.php";
    }

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garçons</title>
</head>
<style>
    table,td,th {
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h3>Garçons</h3>
    <br>
    <a href="cadastrogarcom.php">Novo Garçom</a>
    <table>
        <thead>
            <tr>
                <th>idUser</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    while ($row = mysqli_fetch_array($garcom)) {
                        echo "<tr>";
                        echo "<td>".$row['idUsuario']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td>".$row['telefone']."</td>";
                        echo "<td>".$row['endereco']."</td>";
                        echo "<td>".$row['cpf']."</td>";
                        echo "<td>".$row['rg']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "</tr>";
                    }
                ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo $voltar; ?>">Voltar</a>
</body>
</html>