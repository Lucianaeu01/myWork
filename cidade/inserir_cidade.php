<?php 
error_reporting(0);
include("../includes/conexaoMywork.php");

if(!empty($_GET["id"])) {
    $sql = "SELECT * FROM tb_cidade WHERE pk_id = " . base64_decode($_GET["id"]);
    $rs = mysqli_query($conecta,$sql);

    if(mysqli_num_rows($rs)>0) {
        $row = mysqli_fetch_object($rs);
    } else {
        $msg = base64_encode("Registro não encontrado!");
        $tipo = base64_encode("alert-danger");

        header("Location: lista_cidade.php?msg=$msg");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Inserir cidade</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
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
                                <input class="form-control" type="text" id="cidade" name="cidade" value="<?php echo $row->nome_cidade?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value=""> -- Selecione -- </option>
                                <?php
                            $rs1 = mysqli_query($conecta,"SELECT * FROM tb_estado ORDER BY nome_estado");
                            while($row1 = mysqli_fetch_object($rs1)) {
                                if($row->fk_estado == $row1->pk_id) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option $selected value='$row1->pk_id'> $row1->nome_estado </option>
                                ";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="pk_id" value="<?php echo $_GET["id"]?>">
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
