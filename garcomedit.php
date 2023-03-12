<?php 
session_start();
//print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true || ($_SESSION['nivel']) != 1)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }
    if (!empty($_GET)) {
        include_once("config.php");
        $idGarcom = $_GET['idUsuario'];

        $garcomQuery = 'SELECT * FROM usuario WHERE idUsuario ='.$idGarcom;
        $garcom = $conexao->query($garcomQuery);
        $garcom = mysqli_fetch_array($garcom);
    }
    $logado = $_SESSION['email'];
    
    if (isset($_POST['update'])) 
    {
        //print_r($_POST['nome']);
        //print_r("<br>");
        //print_r($_POST['email']);
        //print_r("<br>");
        //print_r($_POST['telefone']);
        //print_r("<br>");
        //print_r($_POST['cpf']);
        //print_r("<br>");
        //print_r($_POST['rg']);
        //print_r("<br>");
        //print_r($_POST['senha']);
        //print_r("<br>");
        //print_r($_POST['confirmarSenha']);
        include_once("config.php");
        include_once("functions.php");

        $idGarcom = $_POST['idUsuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone= $_POST['telefone'];
        $endereco= $_POST['endereço'];
        $cpf=$_POST['cpf'];
        $rg=$_POST['rg'];
        $senha=$_POST['senha'];
        $confirmarSenha=$_POST['confirmarSenha'];
        $nivel=0;


        if(validarCPF($cpf) == true)
        {
            if($senha == $confirmarSenha)
            {
                $result = mysqli_query($conexao,"UPDATE usuario SET nome='$nome',telefone='$telefone'
                ,endereco='$endereco',cpf='$cpf',rg='$rg',email='$email',senha='$senha'
                WHERE idUsuario =".$idGarcom);
                header("Location:garcom.php");
            }
            else
            {
                echo "ERRO: Senha diferente na confirmação de senha";
            }
        }else
        {
            echo "ERRO: CPF Inválido";
        }
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Garcom</title>
</head>
<body>
    <form method="post" action="garcomedit.php">
        <label for="nome">Nome:</label>
        <input type="text" value="<?php echo $garcom['nome']?>" name="nome">
        <br>
        <label for="email">Email:</label>
        <input type="text" value="<?php echo $garcom['email']?>" name="email">
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" value="<?php echo $garcom['telefone']?>" name="telefone">
        <br>
        <label for="endereço">Endereço:</label>
        <input type="text" value="<?php echo $garcom['endereco']?>" name="endereço">
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" value="<?php echo $garcom['cpf']?>" name="cpf">
        <br>
        <label for="rg">RG:</label>
        <input type="text" value="<?php echo $garcom['rg']?>" name="rg">
        <br>
        <label for="senha">Senha</label>
        <input type="password" value="<?php echo $garcom['senha']?>" name="senha">    
        <br>
        <label for="confirmarSenha">Confirme a sua senha</label>
        <input type="password" value="<?php echo $garcom['senha']?>" name="confirmarSenha"> 
        <br>
        <input type="hidden" value="<?php echo $idGarcom ?>" name="idUsuario">
        <br>
        <input type="submit" name="update" value="Atualizar">     
</form> 
    <a href="sistemagerente.php">Voltar</a>
</body>
</html>