<?php 
include("../includes/conexaoMywork.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Cliente</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>

<body class="bg-dark">
    <div class="container text-light">
        <div class="row">
            <div class="col-12">
                <h2>Alterar Registro</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="salva_alteracao.php">

                    <?php
                        $pk_id = $_GET['pk_id'];
                    ?>

                    <input type="hidden" value="<?php echo $pk_id ?>" id="pk_id" name="pk_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" id="nome" name="nome">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Data de Nascimento:</label>
                                <input class="form-control" type="date" id="data_nascimento" name="data_nascimento">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">CPF:</label>
                                <input class="form-control" type="text" id="cpf" name="cpf">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Email:</label>
                                <input class="form-control" type="email" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Telefone:</label>
                                <input class="form-control" type="text" id="telefone" name="telefone">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Celular:</label>
                                <input class="form-control" type="text" id="celular" name="celular">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome">Cidade:</label>
                        <select class="form-control" id="cidade" name="cidade">
                            <option value="">-- Selecione --</option>
                            <?php 
                                $rs = mysqli_query($conecta,"SELECT * FROM tb_cidade ORDER BY nome_cidade");
                            while($row = mysqli_fetch_object($rs)) {
                                echo "<option value='$row->pk_id'> $row->nome_cidade </option>";
                            }                           
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-outline-danger">Limpar</button>
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
