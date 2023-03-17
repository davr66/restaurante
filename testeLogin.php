<?php 
    session_start();
    //print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        //acessa
        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        
        print_r('Email:'.$email);
        print_r('<br>');
        print_r('Senha: '.$senha);

        $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $result = $conexao->query($sql);

        $queryNivel = "SELECT nivel FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $nivel = $conexao->query($queryNivel);
        $nivelArray = mysqli_fetch_array($nivel);
        $nivel = $nivelArray[0];
        //print_r($sql);
        //print_r($result);
        $queryNome = "SELECT nome FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $nome = $conexao->query($queryNome);
        $nomeArray = mysqli_fetch_array($nome);
        $nome = $nomeArray[0];

        if(mysqli_num_rows($result) < 1)
        {
            header("Location:login.php");
        }
        else
        {
            if($nivel)
            {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['nivel'] = $nivel;
            $_SESSION['nome'] = $nome;

            header("Location:sistemagerente.php");
            }
            else
            {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['nivel'] = $nivel;
            $_SESSION['nome'] = $nome;
            header("Location:sistemagarcom.php");
            }
        }
    }
    else
    {
        header("Location:login.php"); //nao acessa
    }
?>