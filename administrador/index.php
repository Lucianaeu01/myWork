<?php 
include_once("../includes/conexaoMyWork.php");
include('../includes/autenticacao_adm.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css" />
    <title>Painel Adm</title>
</head>
<style>

    a{
        color: white;
        text-decoration: none !important;
    }
    a:hover{
        background-color: white;
        color: black;
    }
</style>
<body class="bg-dark text-light">
    <div class="container centro"><br>
        <div class="row">
            <a class="col-4 text-center mb-5 h1" href="../categoria/index.php">
                <img src="../imagens/categoria.jpg" class="img-responsive rounded-circle" width="300"><br>
                Categorias
            </a>
            <a class="col-4 text-center mb-5 h1" href="../servico/index.php">
                <img src="../imagens/servico.jpg" class="img-responsive rounded-circle" width="300"><br>
                Servicos
            </a>
            <a class="col-4 text-center mb-5 h1" href="../prestador/index.php">
                <img src="../imagens/cliente_prestador.jpg" class="img-responsive rounded-circle" width="300"><br>
                Prestadores
            </a>
        </div>
        <div class="row">
            <a class="col-4 text-center mb-5 h1" href="../cliente/index.php">
                <img src="../imagens/cliente_prestador.jpg" class="img-responsive rounded-circle" width="300"><br>
                Clientes
            </a>
            <a class="col-4 text-center mb-5 h1" href="../cidade/index.php">
                <img src="../imagens/cidade.jpg" class="img-responsive rounded-circle" width="300"><br>
                Cidades
            </a>
             <a class="col-4 text-center mb-5 h1" href="../estado/index.php">
                <img src="../imagens/estado.jpg" class="img-responsive rounded-circle" width="300"><br>
                Estados
            </a>
        </div>
        <div class="row">
           <a class="col-4"></a>
            <a class="col-4 text-center mb-5 h1" href="../login_adm.php">
                <img src="../imagens/logoff.jpg" class="img-responsive rounded-circle" width="300"><br>
                Logoff
            </a>
        </div>  
    </div>
</body>

</html>
