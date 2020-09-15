<?php 

include_once("../includes/conexaoMywork.php");
if($_POST["perfil"]== "administrador"){
    $sql="SELECT * FROM tb_".$_POST["perfil"]." WHERE     
    email='".mysqli_real_escape_string($conecta, $_POST["email"])."' ";
   
}else{
    $sql="SELECT * FROM tb_".$_POST["perfil"]." WHERE 
    cpf='".mysqli_real_escape_string($conecta, $_POST["cpf"])."' AND 
    email='".mysqli_real_escape_string($conecta, $_POST["email"])."' AND 
    data_nascimento='".mysqli_real_escape_string($conecta, $_POST["data_nascimento"])."'";
}


$rs=mysqli_query($conecta,$sql);
if(mysqli_num_rows($rs)==0){
    $msg=base64_encode("As informações digitadas estão incorretas");
    header("LOCATION:confirma_dado.php?msg=$msg");exit;
}else{
    $codigo=substr(sha1(time().uniqid()),-5);
    $row=mysqli_fetch_object($rs);
    $sql1="UPDATE tb_".$_POST["perfil"]." SET codigo='$codigo' WHERE pk_id=".$row->pk_id;
    $rs1=mysqli_query($conecta, $sql1);
    $corpoMensagem="
    <p> Para cadastrar a nova senha utilize o código: $codigo </p>
    <p>Clique no link abaixo para recuperar o seu acesso: </p>
    http://localhost/Mywork/redefinir_senha/redefinir_senha_codigo.php

    ";
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