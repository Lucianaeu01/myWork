<?php 
include('include/conexao_estado.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Novo Registro</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="salva_estado.php">
                <div class="form-group">
                        <label for="UF">Estado:</label>
                        <input class="form-control" type="text" id="estado" name="estado">
                    </div>
                       

                    <div class="form-group">
                        <label for="UF">UF:</label>
                        <input class="form-control" type="text" id="uf" name="uf">
                    </div>
                       

                     <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Salvar </button>
                            <button type="reset" class="btn btn-outline-danger"> Limpar </button>
                    
                    </div>
        
                </form>
                
            </div>
        </div>


    </div>

    <script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
    
</body>
</html>