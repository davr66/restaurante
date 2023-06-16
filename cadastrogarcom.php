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
                
                echo "<script>alert('Garçom cadastrado!');
                window.location.href='garcom.php';</script>";
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
    <link rel="stylesheet" href="css/cadastro.css">
    <script defer src="js/main.js"></script>
</head>
</head>
<body>
    <main>
        <section class="conteudo">
            <img src="img/LogoOrchid.png" alt="logoTIPO" class="logoT">
            <div class="conteudo-principal">
            <h4 class="apresentacao">Cadastrar <mark class="ORCHID">GARÇOM</mark></h4>
    <form method="post" action="cadastrogarcom.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" class="caixa-Registro" required>

        <label for="email">Email:</label>
        <input type="text" name="email" class="caixa-Registro" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" maxlength="15" name="telefone" class="caixa-Registro" required>

        <label for="endereço">Endereço:</label>
        <input type="text" name="endereço" class="caixa-Registro" required>

        <label for="cpf">CPF:</label>
        <input type="text" maxLength="14" id="cpf" name="cpf" class="caixa-Registro" required>

        <label for="rg">RG:</label>
        <input type="text" maxLength="10" name="rg" class="caixa-Registro" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" class="caixa-Registro" required>    

        <label for="confirmarSenha">Confirme a sua senha</label>
        <input type="password" name="confirmarSenha" class="caixa-Registro" required> 

        <input type="submit" name="submit" value="Enviar" class="botao-Env"> 

        <button class="botao-Env" onclick="javascript:history.go(-1)">Voltar</button>  
</form> 

    </div>
    </section>
    </main>
    <div class="fundoIMG"></div>
</body>
</html>