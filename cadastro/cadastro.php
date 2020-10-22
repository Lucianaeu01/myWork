<?php
 include("../area-administrativa/includes/conexaoMywork.php");  

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>
<body class="bg-dark">
    <div class="container text-white">
    <div class="row">
            <div class="col-12">
                <form method="post" action="salvar_cadastro.php" enctype="multipart/form-data" >
                <h1 class="ls-cadastro-logo">CADASTRO MY WORK</h1>                 
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">*Nome:</label>
                                <input class="form-control" type="text" id="nome" name="nome" placeholder="nome" required>
                            </div>
                        </div>                      
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cpf">*CPF:</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" data-mask="000.000.000-00" placeholder="CPF" required>
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="data_nascimento">*Data Nascimento:</label>
                                <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" placeholder="data_nascimento" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">                    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nome">*Endereço:Rua/Av, Bairro</label>
                                <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Digite seu endereço completo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cidade">*Cidade</label>
                                <input class="form-control" type="text" id="cidade" name="cidade" placeholder="cidade" required>
                            </div>
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cidade">*UF</label>
                                <?php 
                                $sql="SELECT * FROM tb_estado";
                                $rs=mysqli_query($conecta,$sql);
                                ?>
                                <select class="form-control" name="estado" required>
                                    <option value="">--Selecione um Estado--</option>
                                    <?php 
                                    while($row=mysqli_fetch_object($rs)){                                    
                                    ?>
                                    <option value="<?php echo $row->pk_id ?>"><?php echo $row->nome_estado; ?></option> 
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>                             
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nome">*Email:</label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-6">                     
                            <div class="form-group">
                                <label for="nome">Telefone:</label>
                                <input class="form-control" type="text" id="telefone" name="telefone" data-mask="(00)0000-0000" placeholder="telefone">
                            </div>
                        </div>                   
                   
                    
                        <div class="col-6">                       
                            <div class="form-group">
                                <label for="nome">*Celular:</label>
                                <input class="form-control" type="text" id="celular" name="celular" data-mask="(00)00000-0000" placeholder="celular" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">*Senha:</label>
                                <input class="form-control" type="password" id="senha" name="senha" placeholder="Digite a senha" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nome">*Confirme a senha:</label>
                                <input class="form-control" type="password" id="senha_confirma" name="senha_confirma" placeholder="Confirme a senha" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto">Foto:</label><br>
                                <input type="file" id="foto" name="foto">
                            </div>
                        </div>
                    </div>
                        <?php 
                            if(!empty($row->foto)) { ?>
                        <div class="col-2">
                            <div class="form-group">
                                <img src="../fotos/<?php echo $row->foto;?>" width="150">
                            </div>
                        </div>
                            <?php } ?> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="cliente" id="cliente" value="cliente" checked>
                                <label class="form-check-label" for="cliente">
                                Cliente
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="prestador" id="prestador" value="prestador">
                                <label class="form-check-label" for="prestador">
                                    Prestador
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <br>
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

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="../css/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    
    
</body>
</html>