<?php 
error_reporting(0);
include("../includes/conexaoMywork.php");
include('../includes/autenticacao.php');

if(!empty($_GET["id"])) {
    $sql = "SELECT * FROM tb_categoria WHERE pk_id = " . base64_decode($_GET["id"]);
    $rs = mysqli_query($conecta,$sql);

    if(mysqli_num_rows($rs)>0) {
        $row = mysqli_fetch_object($rs);
        if($row->habilita == "a") {
            $check = "checked";
        } else{
            $check = "";
        }

    } else {
        $msg = base64_encode("Registro não encontrado!");
        $tipo = base64_encode("alert-danger");

        header("Location: index.php?msg=$msg");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Inserir Categoria</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../css/bootstrap.bundel.js"></script>
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
                <form method="post" action="salva_categoria.php" enctype="multipart/form-data">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="habilita" name="habilita" <?php echo $check;?>>
                                <label class="custom-control-label" for="habilita">Habilita:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">Categoria:</label>
                                <input class="form-control" type="text" id="categoria" name="categoria" value="<?php echo $row->categoria?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="foto">Foto:</label>
                                <input type="file" id="foto" name="foto"><br>
                            </div>
                        </div>
                        <?php 
                            if(!empty($row->foto)) { ?>
                        <div class="col-2">
                            <div class="form-group">
                                <img src="../fotos/<?php echo $row->foto;?>" width="150">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="pk_id" value="<?php echo $_GET["id"]?>">
                        <input type="hidden" name="nome_foto" value="<?php echo $row->foto?>">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-danger">Limpar</button>
                        <a href="index.php">
                            <button type="button" class="btn btn-warning">Voltar</button>
                        </a>
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
