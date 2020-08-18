<?php 
session_start();
$limite = 600;
$tempo = $_SESSION['tempo'];
$agora = time();

$tempodif= $agora - $tempo;

    if($tempodif <= $limite){
        $_SESSION['tempo'] = time();
        if(!empty($_SESSION['token']) && !empty($_COOKIE['token']) && $_SESSION['token']===$_COOKIE['token']){
            
        }else{
            $msg = base64_encode("Problema em dua sessão! Faça login novamente");
            $_SESSION = array();
            session_destroy();
            setcookie('token','',time()-3600);
            header ("location: login.php?msg=$msg");
            exit;
        }
    
    }else{
        $msg = base64_encode("Tempo expirado!");
        $_SESSION = array();
        session_destroy();
        setcookie('token','',time()-3600);
        header ("location: login.php?msg=$msg");
        exit;
    }

?>