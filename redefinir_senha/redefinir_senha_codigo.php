<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome-free-5.14.0-web/css/all.css">
    <title>Redefinir Senha Código</title>
</head>
<style>    
       body{
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
                <form role="form" method="post" action="redefinir_senha_final.php">
                    <fieldset>
                        
                        <div class="form-group ls-login-password">
                            <label for="codigo">Código</label>
                            <input class="form-control ls-login-bg-password input-lg" id="codigo" name="codigo" type="password" aria-label="codigo" placeholder="Digite código" required>
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
