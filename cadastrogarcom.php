<?php 
session_start();
//print_r($_SESSION);
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true || ($_SESSION['nivel']) != 1)) 
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location:login.php");
    }

    $logado = $_SESSION['email'];
    
    if (isset($_POST['submit'])) 
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
                $cpf = preg_replace('/[^0-9]/', "", $cpf);
                $result = mysqli_query($conexao,"INSERT INTO usuario(nome,telefone,endereco,cpf,rg,email,senha,nivel) 
                VALUES ('$nome','$telefone','$endereco','$cpf','$rg','$email','$senha',$nivel)");
                
                echo "<script>alert('Garçom cadastrado!')</script>";
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
    <title>Cadastro de Garcom</title>
</head>
<body>
    <form method="post" action="cadastrogarcom.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome">
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email">
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone">
        <br>
        <label for="endereço">Endereço:</label>
        <input type="text" name="endereço">
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf">
        <br>
        <label for="rg">RG:</label>
        <input type="text" name="rg">
        <br>
        <label for="senha">Senha</label>
        <input type="password" name="senha">    
        <br>
        <label for="confirmarSenha">Confirme a sua senha</label>
        <input type="password" name="confirmarSenha"> 
        <br>
        <input type="submit" name="submit" value="Enviar">     
</form> 
    <a href="sistemagerente.php">Voltar</a>
</body>
</html>
