<?php 
    include_once('includes/conexaoMywork.php');
    session_start();

    if(!empty($_POST)){
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $sql = "SELECT * FROM tb_administrador WHERE email = '$login' AND senha = '".sha1(md5($senha))."'";
        
        $rs = mysqli_query($conecta,$sql);
        
        if(mysqli_num_rows($rs) > 0){
            $sql = "SELECT * FROM tb_administrador WHERE habilita = 'a' AND email = '$login' AND senha = '".sha1(md5($senha))."'";
        
            $rs1 = mysqli_query($conecta,$sql);
            if(mysqli_num_rows($rs1) > 0){
                $row = mysqli_fetch_object($rs);
                $token = md5(date("YmdHis").$row->email);
                $_SESSION['tempo']= time();
                $_SESSION['categoria']= "area-administrativa";
                $_SESSION['token']= $token;
                setcookie('token',$token, time() + (86400 * 30), "/");
                $msg = base64_encode("Login efetuado com sucesso");            
                header("location: index.php?msg=$msg");
            }else {
                $msg = base64_encode("Usuário em análise");
            }      
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
