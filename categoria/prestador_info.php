    <?php
    include_once("../includes/conexaoMywork.php");
    include('../includes/autenticacao.php');
    if(!empty($_GET["id"])) {
    $sql = "SELECT nome, email, telefone, celular,p.foto FROM tb_prestador AS p INNER JOIN rl_prestador_servico AS rl ON p.pk_id=rl.fk_prestador INNER JOIN tb_servico AS s ON s.pk_id=rl.fk_servico WHERE fk_servico = " . base64_decode($_GET["id"]);  
    $rs = mysqli_query($conecta,$sql);
        if(mysqli_num_rows($rs)>0) {
            $row = mysqli_fetch_object($rs);
        }else{
            $msg = base64_encode("Registro não encontrado!");
        }
    }
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css" />
        <title>Lista de Prestadores</title>
    </head>

    <style>
        td {
            padding-top: 60px;
        }

    </style>

    <body class="bg-dark">
        <div class="container"><br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th></th>
                    </tr>
                </thead>
                <tr class="bg-white">
                   <td>
                    <?php 
                    if(!empty($row->foto)) { ?>
                    <div class="col-2">
                        <div class="form-group">
                            <img src="../fotos/<?php echo $row->foto;?>" width="150">
                        </div>
                    <?php } ?>
                    </div>
                    </td>
                    <td style="padding-top: 65px" ><?php echo $row->nome;?></td>
                    <td style="padding-top: 65px" ><?php echo $row->email;?></td>
                    <td style="padding-top: 65px" ><?php echo $row->telefone;?></td>
                    <td style="padding-top: 65px" ><?php echo $row->celular;?></td>
                    <td style="padding-top: 65px" ><a href="prestadores.php?id=<?php echo base64_encode($row->pk_id)?>">
                            <button type="submit" class="btn btn-info">[Ver prestador]</button>
                        </a>
                    </td>
                </tr>
            </table>
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

        <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="../css/bootstrap.bundle.js"></script>

    </body>

    </html>
