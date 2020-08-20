<?php
include_once('includes/conexaoMywork.php');
include_once('includes/autenticacao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="bootstrap/bootstrap.css" />
    <link rel= "stylesheet" href="fontawesome-free-5.14.0-web/css/all.css" />
    
    <title>Projeto Integrador</title>
</head>
<body>

<div class = "container container-fluid"> 
    <div class="box-parent-login">
        <div class="well bg-white box-login">
            <h1 class="ls-login-logo">MY WORK - BEM VINDO!</h1>
            
        </div>
    </div>
</div>
    <div class ="row">
        <div class="col-12">
            <h3>CADASTROS</h3>
        </div>
        <?php
        if($_SESSION["categoria"]=="prestador") { ?>
        <div class="col-12 col-md-6 border text-center">
            <span class="badge badge-primary">
                <i class="fas fa-user"> </i>
            </span>
            <br>
            CLIENTES
            </div>
        <?php } ?>
        <?php 
        if($_SESSION["categoria"]=="cliente") { ?>
        <div class="col-12 col-md-6 border text-center">
            <span class="badge badge-info">
                <i class="fas fa-tools"></i>
            </span>
            <br>
            PRESTADOR DE SERVIÇO 
            </div>
        <?php } ?>
        </div> 
    </div>
        
    <div class="modal fade" id="modalMensagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            
            </button>
        </div>
        <div class="modal-body">
        <?php echo base64_decode($_GET["msg"]); ?>
       
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            
        </div>        
        </div>
    </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/bootstrap.bundle.js"></script>
    <script>
    $(function () {       
        <?php if(!empty($_GET["msg"])) { ?>
        $('#modalMensagem').modal('show');
        <?php } ?> 

    });
    </script>
</body>
</html>