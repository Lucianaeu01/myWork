<?php 
include_once("include/conexao_estado.php");


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="css/bootstrap.css" />
    <title>Document</title>
</head>
<body>




<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>

<div class="container">

    <div class = "row">
        <div class = "col-12">
            <a href="inserir_estado.php" class="btn btn-outline-primary">Novo</a>

        </div>
    </div>    
    
<table class="table table-striped">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Estado</th>
            <th>UF</th>
            <th>Ação</th>

            
        </tr>
    
    </tehad>
<?php 
    $sql =mysqli_query($conecta, "SELECT * FROM tb_estado");
    while($row = mysqli_fetch_object($sql)){

?>    
    <tr>
        <td><?php echo $row->pk_id; ?></td>
        <td><?php echo $row->nome_estado; ?></td>
        <td><?php echo $row->UF; ?></td>
        <td><a href="#" class="btn btn-outline-secondary">[alterar]</a> 
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalExcluir" data-id="<?php echo $row->pk_id; ?>">
        [excluir]
        </button>
    </tr>

<?php 
    }
?>    
</table>
   
 
    <!-- Modal -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="post" action="remover_estado.php">
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
    <!-- Modal -->
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
        </form>
        </div>
    </div>
    </div>
</div>

<script>
    $(function () {
        $('#modalExcluir').on('show.bs.modal', function (e) {
            var id_registro = $(e.relatedTarget).data('id');
            $('#pk_id').val(id_registro);
        })
        <?php if(!empty($_GET["msg"])) { ?>
        $('#modalMensagem').modal('show');
        <?php } ?>         
    });
    </script>
    
</body>
</html>