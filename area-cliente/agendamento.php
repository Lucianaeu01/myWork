<?php 
include("includes/conexaoMywork.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<style>
    tr:hover{
        background-color: aqua !important;

    }
    .centro {
        padding-top: 35px !important;
    }
</style>
<body>
    <div class="container">
        <div class="col-12 text-center h1">Escolha o serviço desejado</div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select class="custom-select mr-sm-2" name="categoria" id="categoria">
                        <option value=""> -- Escolha uma categoria --</option>
                        <?php
                            $sql = "SELECT pk_id, categoria
                                FROM tb_categoria
                                ORDER BY categoria";
                            $res = mysqli_query($conecta,$sql);
                            while ( $row = mysqli_fetch_assoc( $res ) ) {
                              echo '<option value="'.$row['pk_id'].'">'.$row['categoria'].'</option>';
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="servico">Serviços:</label>
                    <select class="custom-select mr-sm-2" name="servico" id="servico">
                        <option value="">-- Escolha um serviço --</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Cidade</th>
                </tr>
            </thead>
            <tbody id="prestador"></tbody>
        </table>
    </div>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../css/bootstrap.bundle.js"></script>
     <script>
        $(document).ready(function() {
            $('#categoria').change(function() {
                $('#servico').load('carrega_servico.php?ref=' + $('#categoria').val());
                //$("#prestador").remove();
            });
        });
         $(document).ready(function() {
            $('#servico').change(function() {
                $('#prestador').load('carrega_prestador.php?ref1=' + $('#servico').val());
            });
        });
    </script>
</body>

</html>
