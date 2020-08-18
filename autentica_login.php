<?php 
    include_once('includes/conexaoMywork.php');
    session_start();

    if(!empty($_POST)){
        $login = $_POST['userLogin'];
        $categoria = "tb_" . $_POST['userCategoria'];
        $senha = $_POST['userPassword'];
        
        $sql = "SELECT * FROM $categoria WHERE email = '$login' AND senha = '".md5($senha)."'";
        
        $rs = mysqli_query($conecta,$sql);
        
        if(mysqli_num_rows($rs) > 0){
            $row = mysqli_fetch_object($rs);
            $token = md5(date("YmdHis").$row->email);
            $_SESSION['categoria'] = $_POST["userCategoria"];
            $_SESSION['tempo']= time();
            $_SESSION['token']= $token;
            setcookie('token',$token, time() + (86400 * 30), "/");
            $msg = base64_encode("Login efetuado com sucesso");
            header("location: index.php?msg=$msg");
            exit;     
        }else{
        $_SESSION = array();
        session_destroy();
        setcookie('token','', time()-3600);
        $msg = base64_encode("Usuário ou senha inválidos");
            
        }
    header("location: login.php?msg=$msg");
    }

?>
