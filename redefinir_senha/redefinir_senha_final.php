<?php
 include_once("../includes/conexaoMywork.php");
 $sql1="SELECT * FROM tb_cliente WHERE codigo ='" .$_POST["codigo"]."'";
 $sql2="SELECT * FROM tb_prestador WHERE codigo ='" .$_POST["codigo"]."'";
 $sql3="SELECT * FROM tb_administrador WHERE codigo ='" .$_POST["codigo"]."'";
$tabela="";
$id=0;
$rs1=mysqli_query($conecta,$sql1);
 if(mysqli_num_rows($rs1)!= 0){
    $tabela= "cliente";
    $row=mysqli_fetch_object($rs1);
    $id=$row->pk_id;
 }
 $rs2=mysqli_query($conecta,$sql2);
 if(mysqli_num_rows($rs2)!= 0){
    $tabela= "prestador";
    $row=mysqli_fetch_object($rs2);
    $id=$row->pk_id;
 }
 $rs3=mysqli_query($conecta,$sql3);
 if(mysqli_num_rows($rs3)!= 0){
    $tabela= "administrador";
    $row=mysqli_fetch_object($rs3);
    $id=$row->pk_id;
 }
//echo $tabela;
//echo $id; 
//exit;
 if(empty($tabela)||$id==0){
 
    echo $msg=base64_encode("Código não confere!"); 
    header("LOCATION:../login.php?msg=$msg");
    exit;
 }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css">
    <title>Redefinir senha final</title>
</head>
<style>
    body {
        background-color: white;
    }

    .content {
        position:absolute;
        width: 500px;
        min-height: 560px;
		left:35%;
		top:25%;
		margin-top:-40px;
        background-color: white;
        color: black;

    }

</style>

<body>
    <div class="container content">
        <div class="box-parent-login">
            <div class="well bg-black box-login sp"><br>
                <h1 class="ls-login-logo text-center">MY WORK</h1>
                <form role="form" method="post" action="salvar_senha.php">
                    <fieldset>
                        <div class="form-group ls-login-password">
                            <label for="novaSenha">Nova Senha</label>
                            <input class="form-control ls-login-bg-user input-lg" id="novaSenha" name="novaSenha" type="password" aria-label="novaSenha" placeholder="Digite sua senha" required>
                            <input type="hidden" name="tabela" value="<?php echo $tabela ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                        <br>
                        <div class="form-group ls-login-password">
                            <label for="confirmaSenha">Confirma Senha</label>
                            <input class="form-control ls-login-bg-password input-lg" id="confirmaSenha" name="confirmaSenha" type="password" aria-label="confirmaSenha" placeholder="Confirme sua senha" required>
                        </div>  
                        <br><br>                     
                        <div class="form-group">                        
                        <button type="submit" class="btn btn-primary">Salvar</button>                                           
                </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
   
               
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../css/bootstrap.bundle.js"></script>
    <script>
        $(function() {
            <?php if(!empty($_GET["msg"])){ ?>
            $('#modalMensagem').modal('show');
            <?php } ?>
        })

    </script>
</body>

</html>
