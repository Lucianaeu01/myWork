<?php
    include_once("../includes/conexaoMywork.php");
    
   

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css">
    <title>Confirmação de Dados</title>
</head>
<style>
    .icone:hover {
        background-color: skyblue;
    }
</style>
<body class="bg-dark">
    <div class="container text-white">
        <div class="row">
            <div class="col-12">
                <h2>Confirmação de dados</h2>
            </div>
        </div><br>

<div class="row">
            <div class="col-12">
                <form method="post" action="recuperar_senha.php" >
                <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento:</label>
                                <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control" type="email" id="email" name="email" required>
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="perfil">Perfil</label>
                                <select class="form-control" id="perfil" name="perfil" required>
                                    <option value=""> -- Selecione -- </option>
                                    <option value="cliente"> Cliente </option>
                                    <option value="prestador"> Prestador </option>
                                    <option value="administrador"> Administrador </option>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Voltar</button>
                            <button type="reset" class="btn btn-danger">Limpar</button>                                
                            <button type="submit" class="btn btn-warning">Enviar código</button>
                                
                            </div>
                        </div>
                        </div>
    </body>
</html>