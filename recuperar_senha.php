<?php 

include_once("../includes/conexaoMywork.php");

$sql="SELECT * FROM tb_".$_POST["perfil"]." WHERE 
cpf='".mysqli_real_escape_string($_POST["cpf"])."' AND 
email='".mysqli_real_escape_string($_POST["email"])."' AND 
data_nascimento='".mysqli_real_escape_string($_POST["data_nascimento"])."'";

$rs=mysqli_query($conecta,$sql);
if(mysqli_num_rows($rs)==0){
    $msg=base64_encode("As informações digitadas estão incorretas");
    header("LOCATION:../login.php?msg=$msg");exit;
}else{
    echo "ok";exit;
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
    $mail->Username="mywork@gmail.com";            
    $mail->Password="1234";                       
    $mail->Port="587";                                  

    
    $mail->setFrom("mywork@gmail.com");            
    $mail->addAddress("");        
    $mail->Charset="UTF-8";                             
    $mail->isHTML(true);                                
    $mail->Subject="redefinição de senha";              
    $mail->Body="mensagem do corpo do <strong>email</strong>";  
    $mail->AltBody="mensagem do corpo do email";        

    if($mail->send()){
        echo "e-mail enviado com sucesso";
        

    }else{
        echo "e-mail não enviado";
        
    }



}catch(Exception $e){
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";


}


?>