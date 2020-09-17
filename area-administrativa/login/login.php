<?php
include_once('../includes/conexaoMywork.php');

if(!empty($_POST)){
    session_start();
    $login = $_POST['userLogin'];
    $senha = $_POST['userPassword'];
    $categoria = "tb_" . $_POST['userCategoria'];

    $sql = "SELECT * FROM $categoria WHERE email = '$login' AND senha = '".md5($senha)."'";
    
    $result = mysqli_query($conecta,$sql);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_object($result);
        $token = md5(date("YmdHis").$row->email);
        $_SESSION['categoria'] = $_POST["userCategoria"];
        $_SESSION['tempo'] = time();
        $_SESSION['token'] = $token;
        setcookie('token',$token,time() + (86400 * 30), "/");
        //redirecionar para primeira página do sistema
        $msg = base64_encode("Login efetuado com sucesso!");
        header ('location: ../index.php?msg=' .$msg);
        exit;

    } else{       
        $msg = base64_encode("Usuário ou senha inválidos");
        $_SESSION = array();
        session_destroy();
        setcookie('token', '', time()-3600); //tempo negativo e/ou valor vazio ('') para apagar cookie
    }

    echo "Desenvolver na tela de login o Modal de Aviso para mensagens;";
    header('location: login.php?msg=' .$msg);
    exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="../css/bootstrap.css" />
    
    <title>Projeto Integrador</title>
</head>
<body>

    <div class = "container container-fluid"> 
    <div class="box-parent-login">
        <div class="well bg-white box-login">
            <h1 class="ls-login-logo">MY WORK</h1>
            <form role="form" method="POST" action="login.php">
                <fieldset>
     
                    <div class="form-group ls-login-user">
                        <label for="userLogin">Usuário</label>
                        <input class="form-control ls-login-bg-user input-lg" id="userLogin" name="userLogin" type="text" aria-label="Usuário" placeholder="Usuário" required>
                    </div>
                    <br>
                    <div class="form-group ls-login-password">
                        <label for="userPassword">Senha</label>
                        <input class="form-control ls-login-bg-password input-lg" id="userPassword" name="userPassword" type="password" aria-label="Senha" placeholder="Senha" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="userCategoria">Categoria</label>
                        <select id="userCategoria" name="userCategoria" class="form-control" required>
                            <option value="">--Selecione--</option>
                            <option value="cliente">Cliente</option>
                            <option value="prestador">Prestador de Serviço</option>
                        </select>
                    </div>
                    <a href="#" class="ls-login-forgot">Esqueci minha senha</a>
                    <br>
                    <input type="submit" value="Entrar" class="btn btn-primary btn-lg btn-block">
                    <!--<button type="submit" name="submit" value="Entrar">LOGIN</button>-->
                    <p class="txt-center ls-login-signup">É cliente e não possui um usuário na MY WORK?
                        <a href="#">Cadastre-se agora</a>
                        <br>
                        É prestador e não possui um usuário na MY WORK?
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
           <?php echo base64_decode($_GET["msg"]); ?>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            
        </div>
        </form>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/bootstrap.bundle.js"></script>
    <script>
    $(function () {       
        <?php if(!empty($_GET["msg"])) { ?>
        $('#modalMensagem').modal('show');
        <?php } ?>         
    });
    </script>
</body>
</html>