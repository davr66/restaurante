<?php 
    include_once('config.php');

    if (!empty($_POST['excluirProd'])) {
        $id = $_POST['idProduto'];

        $deleteProdutoQuery = 'DELETE FROM produto WHERE idProduto ='.$id;
        $conexao->query($deleteProdutoQuery);   
        header("Location:produtos.php");
    }

    if (isset($_POST['excluirCat'])) {
        $id = $_POST['idCategoria'];

        $deleteCategoriaQuery = 'DELETE FROM categoria WHERE idCategoria ='.$id;
        $conexao->query($deleteCategoriaQuery);
        
        header('Location:categoria.php');
    }

    if (isset($_POST['excluirConta'])) {
        $id = $_POST['idConta'];

        $deleteContaQuery = 'DELETE FROM conta WHERE idConta ='.$id;
        $conexao->query($deleteContaQuery);

        header('Location:contas.php');
    }

    if (isset($_POST['excluirUser'])) {
        $id = $_POST['idUsuario'];

        $deleteGarcomQuery = 'DELETE FROM usuario WHERE idUsuario ='.$id;
        $conexao->query($deleteGarcomQuery);

        header('Location:garcom.php');
    }

?>