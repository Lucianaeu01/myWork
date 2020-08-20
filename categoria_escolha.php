<?php 
include("includes/conexaoMywork.php");

if(!empty($_GET["id"])) {
    $sql = "SELECT * FROM tb_categoria WHERE pk_id = " . base64_decode($_GET["id"]);
    $rs = mysqli_query($conecta,$sql);

    if(mysqli_num_rows($rs)>0) {
        $row = mysqli_fetch_object($rs);

        $sql = "SELECT fk_categoria FROM tb_servico WHERE fk_categoria = " . base64_decode($GET["id"]);
        $rs2 = mysqli_query($conecta,$sql);
        while($rowcategoria = mysqli_fetch_object($rs2)) {
            $categoria[] = $rowCategoria->fk_categoria;
        }

        $sql = "SELECT fk_servico FROM tb_servico WHERE fk_servico = " . base64_decode($GET["id"]);
        $rs2 = mysqli_query($conecta,$sql);
        while($rowServico = mysqli_fetch_object($rs2)); {
            $servico[] = $rowServico->fk_servico;
        }

    } else {
        $msg = base64_encode("Serviço não encontrado!");
        $tipo = base64_encode("alert-danger");

        header("Location: categoria.php?msg=$msg&tipo=$tipo");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="bootstrap/bootstrap.css" />

    <title>Categoria</title>
</head>
<body>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>

<div class = "container container-fluid"> 
    <div class="box-parent-login">
        <div class="well bg-white box-login">
            <h1 class="ls-login-logo">MY WORK</h1>
            <form role="form" method="POST" action="login.php">
                <fieldset>

                <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select class="form-control" id="categoria" name="categoria" onchange='encaminha(this.value);'>
                            <option value=""> -- Selecione -- </option>
                            <?php 
                            $rs1 = mysqli_query($conecta,"SELECT * FROM tb_categoria ORDER BY categoria");
                            while($row1= mysqli_fetch_object($rs1)) {
                                if($row->fk_categoria == $row1->pk_id) {
                                    $selected = "selected";
                                } else{
                                    $selected = "";
                                }
                                echo "<option $selected value='$row1->pk_id'> $row1->categoria </option>";
                            }
                            ?>
                        </select>    
                    </div>

                    <div class="form-group">
                        <label for="servico">Serviço:</label>
                        <select class="form-control" id="servico" name="servico">
                            <option value=""> -- Selecione -- </option>
                            <?php 
                            $rs1 = mysqli_query($conecta,"SELECT * FROM tb_servico ORDER BY servico");
                            while($row1= mysqli_fetch_object($rs1)) {
                                if($row->fk_servico == $row1->pk_id) {
                                    $selected = "selected";
                                } else{
                                    $selected = "";
                                }
                                echo "<option $selected value='$row1->pk_id'> $row1->servico </option>";
                            }
                            ?>
                        </select>    
                    </div>    

    <script> 
    function encaminha(v) {
       
        window.location.href='categoria.php?cat='+v;
    } 
    </script>
</body>
</html>