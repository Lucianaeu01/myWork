<?php
 include("../area-administrativa/includes/conexaoMywork.php");
 if(isset($_POST["cliente"])){
    $cliente=$_POST["cliente"];
    $sql="SELECT * FROM tb_cliente WHERE 
    nome='"($_POST["nome"])."' AND
    data_nascimento='".($_POST["data_nascimento"])."' AND
    cpf='".($_POST["cpf"]."' AND
    email='".($_POST["email"]."' AND
    senha='"($_POST["senha"]'";    
    mysqli_query($conecta,$sql);
}    
else(isset($_POST["prestador"])){
    $prestador=$_POST["prestador"];
    $sql="SELECT * FROM tb_prestador WHERE 
    nome='"($_POST["nome"])."' AND
    data_nascimento='".($_POST["data_nascimento"])."' AND
    cpf='".($_POST["cpf"]."' AND
    email='".($_POST["email"]."' AND
    senha='"($_POST["senha"]'";
   
}  
    $msg= base64_encode("Cadastro efetuado com sucesso!");
    header("location:confirma_cadastro.php");
}

$rs=mysqli_query($conecta,$sql);
if(mysqli_num_rows($rs)==0){       
    $sql1="UPDATE tb_".$_POST["perfil"]." WHERE pk_id=".$row->pk_id;
    $rs1=mysqli_query($conecta, $sql1);
    $corpoMensagem="       
    <p>Clique no link abaixo para confirmar o seu cadastro: </p>
    http://localhost/Mywork/cadastro/confirma_cadastro_final.php";
}


require_once("../PHPMailer/PHPMailer.php");
require_once("../PHPMailer/SMTP.php");
require_once("../PHPMailer/exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMAiler\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try{
    
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;             
    $mail->isSMTP();                                    
    $mail->Host="smtp.gmail.com";                           
    $mail->SMTPOptions = array (
        'ssl' => array (
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
    $mail->SMTPAuth=true;                               
    $mail->SMTPSecure="tls";                            
    $mail->Username="projetointegradormywork@gmail.com";            
    $mail->Password="Projet2020";                       
    $mail->Port="587";                                  

    
    $mail->setFrom("projetointegradormywork@gmail.com");            
    $mail->addAddress($_POST["email"]);        
    $mail->Charset="UTF-8";                             
    $mail->isHTML(true);                                
    $mail->Subject="redefinição de senha";              
    $mail->Body=$corpoMensagem;  
           

    if($mail->send()){
        $msg= base64_encode("E-mail enviado com sucesso. Em breve você receberá seu código de acesso");        
        header("LOCATION:redefinir_senha_codigo.php?msg=$msg");exit;
    }else{
        $msg= base64_encode("Falha ao enviar email, tente novamente mais tarde");
        header("LOCATION:../login.php?msg=$msg");exit;

        
    }
    


}catch(Exception $e){
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";


}


?>               