<?php 
<<<<<<< HEAD
    session_start();
    $limite = 600; // 10 minutos de limite de tempo da sessão
    $tempo = $_SESSION['tempo'];
    $agora = time();

    $tempodif= $agora - $tempo;

    if($tempodif <= $limite){
        //echo "sessão continua aberta";
        $_SESSION['tempo'] = time();
        if(!empty($_SESSION['token']) && !empty($_COOKIE['token']) && $_SESSION['token']===$_COOKIE['token']){
            //sessão aberta
            //pode ser desenvolvido alguma lógica adicional à segurança...
            //posso implementar inclusão de LOG no banco de dados...

        }else{
            $msg = base64_encode("Problema em sua sessão! Faça login novamente.");
            $_SESSION = array();
            session_destroy();
            setcookie('token', '', time()-3600); //tempo negativo e/ou valor vazio ('') para apagar cookie
            header ('location: login/login.php?msg='.$msg);
            exit;
    
        }

    } else {
        echo "sessão expirou";
        $msg = base64_encode("Tempo de sessão expirado!");
        $_SESSION = array();
        session_destroy();
        setcookie('token', '', time()-3600); //tempo negativo e/ou valor vazio ('') para apagar cookie
        header ('location: login/login.php?msg='.$msg);
        exit;

=======
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
>>>>>>> 3686e1a2627d5daf00651a180bcb19496fa1b47b
    }

?>