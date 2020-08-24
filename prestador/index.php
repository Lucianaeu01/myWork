<?php
    include_once("../includes/conexaoMywork.php");
    include("../includes/autenticacao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css">
    <title>Lista de Prestador</title>
</head>
<style>
    .icone:hover {
        background-color: skyblue;
    }
</style>

<body class="bg-dark">
    <div class="container"><br>
        <div class="row">
            <div class="col-12">
                <form method="post" action="inserir_prestador.php">
                    <button class="btn btn-light icone">
                        <input type="image" width="40" height="40" src="../imagens/inserir_cliente.png" data-toggle="tooltip" data-placement="top" title="Inserir novo cliente">
                    </button>
                </form>
            </div>
        </div><br>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Cidade</th>
                    <th>Habilita</th>
                    <th>Ação</th>
                </tr>
                <?php 
                
                $sql = mysqli_query($conecta,"SELECT tb_prestador.pk_id, nome, DATE_FORMAT(data_nascimento,'%d/%m/%Y') AS data_nascimento, cpf, email, telefone, celular, nome_cidade, habilita FROM tb_prestador LEFT JOIN tb_cidade ON tb_cidade.pk_id = tb_prestador.fk_cidade ORDER BY tb_prestador.nome");
                while($row = mysqli_fetch_object($sql)){
            ?>
            </thead>
            <tr class="bg-white">
                <td><?php echo $row->pk_id;?></td>
                <td><?php echo $row->nome;?></td>
                <td><?php echo $row->data_nascimento;?></td>
                <td><?php echo $row->email;?></td>
                <td><?php echo $row->cpf;?></td>
                <td><?php echo $row->telefone;?></td>
                <td><?php echo $row->celular;?></td>
                <td><?php echo $row->nome_cidade;?></td>
                <td><?php
                     if($row->habilita == 'a') {
                        echo '<i class="fas fa-check"></i>';
                    }
                    ?></td>
                <td>
                    <a href="inserir_prestador.php?id=<?php echo base64_encode($row->pk_id)?>">
                        <button type="submit" class="btn btn-info">[ alterar ]</button>
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir" data-id="<?php echo $row->pk_id;?>">[ excluir ]</button>
                </td>
            </tr>
            <?php 
                }
                ?>
        </table>
        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="remover_prestador.php">
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
