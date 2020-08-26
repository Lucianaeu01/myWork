<?php
    include_once("../includes/conexaoMywork.php");
    include('../includes/autenticacao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css" />
    <title>Lista de Categoria</title>
</head>

<style>
    .icone:hover {
        background-color: skyblue;
    }

</style>

<body class="bg-dark">
    <div class="container"><br>
        <div class="row text-white">
            <?php 
                $sql = mysqli_query($conecta,"SELECT * FROM tb_categoria WHERE habilita = 'a'");
                while($row = mysqli_fetch_object($sql)){
            ?>
            <div class="col-3 text-center mb-5">
               <img src="../fotos/<?php echo $row->foto ?>" class="img-responsive rounded-circle" width="130"><br>
                <a style="font-size:30px" href="categoria_info.php?id=" <?php $row->pk_id?>><?php echo $row->categoria;?></a><br>
            </div>

            <?php 
                }
            ?>

        </div>
        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="remover_categoria.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Deseja realmente excluir esse registro?
                            <input name="pk_id" id="pk_id" type="hidden">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
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
                        <?php echo base64_decode($_GET["msg"]);?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../css/bootstrap.bundle.js"></script>

    <script>
        $(function() {
            $('#modalExcluir').on('show.bs.modal', function(e) {
                var id_registro = $(e.relatedTarget).data('id');
                $('#pk_id').val(id_registro);
            });
            $('#modalAlterar').on('show.bs.modal', function(e) {
                var id_registro = $(e.relatedTarget).data('id');
                $('#pk_id_edit').val(id_registro);
            });
            <?php if(!empty($_GET["msg"])){ ?>
            $('#modalMensagem').modal('show');
            <?php } ?>
        })

    </script>

</body>

</html>
