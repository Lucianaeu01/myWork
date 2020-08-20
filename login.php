<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Projeto Integrador</title>
</head>
<style>
    body {
        background-image: url(imagens/profissional_futuro_siemens.jpg);
    }

    .content {
        position:absolute;
        width: 500px;
        min-height: 560px;
		left:35%;
		top:25%;
		margin-top:-40px;
        background-color: black;
        color: white;

    }

</style>

<body>
    <div class="container content">
        <div class="box-parent-login">
            <div class="well bg-black box-login sp"><br>
                <h1 class="ls-login-logo text-center">MY WORK</h1>
                <form role="form" method="post" action="autentica_login.php">
                    <fieldset>
                        <div class="form-group ls-login-user">
                            <label for="userLogin">Usuário</label>
                            <input class="form-control ls-login-bg-user input-lg" id="userLogin" name="userLogin" type="text" aria-label="Usuário" placeholder="Digite seu usuário" required>
                        </div>
                        <br>
                        <div class="form-group ls-login-password">
                            <label for="userPassword">Senha</label>
                            <input class="form-control ls-login-bg-password input-lg" id="userPassword" name="userPassword" type="password" aria-label="Senha" placeholder="Digite sua senha" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="userCategoria">Categoria</label>
                            <select id="userCategoria" name="userCategoria" class="form-control" required>
                                <option value=""> -- Selecione -- </option>
                                <option value="cliente"> Cliente </option>
                                <option value="prestador"> Prestador de Serviço </option>
                            </select>
                        </div>
                        <a href="#" class="ls-login-forgot">Esqueci minha senha</a>
                        <br><br><br>
                        <input type="submit" name="" value="Entrar" class="btn btn-primary btn-lg btn-block">
                        <br><br>
                        <!-- <button type="submit" name="submit" value="Entrar">Login</button>-->
                        <p class="txt-center ls-login-signup">Não possui um usuário na MY WORK?
                            <a href="#">Cadastre-se agora</a>
                        </p>
                    </fieldset>
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
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="css/bootstrap.bundle.js"></script>
    <script>
        $(function() {
            <?php if(!empty($_GET["msg"])){ ?>
            $('#modalMensagem').modal('show');
            <?php } ?>
        })

    </script>
</body>

</html>
