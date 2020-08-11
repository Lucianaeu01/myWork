<?php 
include("includes/conexaoMywork.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Inserir cidade</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>

<body class="bg-dark">
    <div class="container text-white">
        <div class="row">
            <div class="col-12">
                <h2>Novo registro</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="salva_cidade.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Nome da cidade:</label>
                                <input class="form-control" type="text" id="cidade" name="cidade" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">UF:</label>
                                <select class="form-control" id="uf" name="uf">
                                    <option value="" required>-- Selecione --</option>
                                    <?php 
                                $rs = mysqli_query($conecta,"SELECT * FROM tb_estado ORDER BY UF");
                            while($row = mysqli_fetch_object($rs)) {
                                echo "<option value='$row->pk_id'> $row->UF </option>";
                            }                           
                            ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-danger">Limpar</button>
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
