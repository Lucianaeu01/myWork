<?php
error_reporting(0);
include("../includes/conexaoMywork.php");
include("../includes/autenticacao_adm.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Inserir Cliente</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="../css/bootstrap.bundle.js"></script>
</head>

<body class="bg-dark">
    <div class="container text-white">
        <div class="row">
            <div class="col-12">
                <h2>Novo registro</h2>
            </div>
        </div><br>
        <div class="row">
            <div class="col-12">
                <form method="post" action="salva_prestador.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="categoria">Categorias:</label>
                                <select class="form-control js-example-basic-multiple" id="categoria" name="categoria[]" multiple>
                                    <?php
                            $rs1 = mysqli_query($conecta,"SELECT * FROM tb_categoria ORDER BY categoria");
                            while($row1 = mysqli_fetch_object($rs1)) {
                                if(in_array($row1->pk_id,$categoria)) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option $selected value='$row1->pk_id'> $row1->categoria </option>
                                ";
                            }
                            ?>
                                </select>
                            </div>
                            <p class="txt-center ls-login-signup">Selecione uma categoria, se não existir a desejada, digite sua sujestão</p>
                            <div class="form-group">
                                <label for="servico">Serviços:</label>
                                <select class="form-control js-example-basic-multiple" id="servico" name="servico[]" multiple>
                                    <?php
                            $rs1 = mysqli_query($conecta,"SELECT * FROM tb_servico ORDER BY servico");
                            while($row1 = mysqli_fetch_object($rs1)) {
                                if(in_array($row1->pk_id,$servico)) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option $selected value='$row1->pk_id'> $row1->servico </option>
                                ";
                            }
                            ?>
                                </select>
                            </div>
                            <p class="txt-center ls-login-signup">Não existe uma categoria ou serviço que interesse?</p>
                            <div class="form-group">
                                <input type="hidden" name="pk_id" value="<?php echo $_GET["id"]?>">
                                <button type="submit" class="btn btn-primary">Próximo</button>
                                <button type="reset" class="btn btn-danger">Limpar</button>
                                <a href="inserir_prestador.php">
                                    <button type="button" class="btn btn-warning">Voltar</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
            }

        </script>
        <script>
            $(function() {
                        <?php if(!empty($_GET["msg"])){ ?>
                        $('#modalMensagem').modal('show');
                        <?php } ?>

        </script>
