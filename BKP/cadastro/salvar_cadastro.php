<?php
 include("../area-administrativa/includes/conexaoMywork.php");  

 require_once("../area-administrativa/PHPMailer/PHPMailer.php");
 require_once("../area-administrativa/PHPMailer/SMTP.php");
 require_once("../area-administrativa/PHPMailer/exception.php");
 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMAiler\SMTP;
 use PHPMailer\PHPMailer\Exception;

 if(isset($_POST)){
        //recuperar os valores dos objetos de formulario
        $nome=$_POST["nome"];
        $nascimento=$_POST["data_nascimento"];
        $endereco=$_POST["endereco"];
        $cidade="'".$_POST["cidade"]."'";
        $senha=$_POST["senha"];
        $senhaConfirma=$_POST["senha_confirma"];
        $cpf=$_POST["cpf"];                
        $celular=$_POST["celular"];
        $estado=$_POST["estado"];
        $email=$_POST["email"]; 
        $codigo=substr(sha1(time().uniqid()),-5);       
                 

     //validar senha
     if(isset($_POST["senha"])){        
         if($senha==$senhaConfirma){
            $senha = sha1(md5($_POST["senha"]));
            $sqlSenha = "senha = '$senha',";          
           
        } else {
            $msg = base64_encode("As senhas digitadas são diferentes! Por favor, digite novamente.");
            header("location:cadastro.php?msg= " .$msg);
            exit;  
                      
        }
    }   
    //Para recuperar a cidade, se não houver na tabela, inserir   
    $sql="SELECT * FROM tb_cidade WHERE nome_cidade= $cidade";
    $rs=mysqli_query($conecta,$sql);
    if(mysqli_num_rows($rs)>=1){
        $row=mysqli_fetch_object($rs);
        $id_cidade=$row->pk_id;
        $cidade='null';
        $estado='null';
    }else{
        $id_cidade='null';
        
    }
   
    //recuperar telefone
    if(empty($_POST["telefone"])){
        $telefone='null';
        
    }else{
        $telefone=$_POST["telefone"];
    }
    
   //recuperar foto se houver alem de recuperar, mudar nome da foto e mover para o servidor
   $permitidos= array("image/jpeg", "image/png");
   $caminho="../area-administrativa/fotos/";
    if($_FILES["foto"]["error"]<>4) {
        $tipo = $_FILES["foto"]["type"];

        if(in_array($tipo,$permitidos)){
            $extensao = explode(".",$_FILES["foto"]["name"]);
            $extensao = end($extensao);
            $nome_foto = sha1($_FILES["foto"]["tmp_name"] . time() . uniqid()) . "." . $extensao;
            
            move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho .$nome_foto);
        }else{
            $msg="Tipo de arquivo inválido, favor inserir uma foto PNG ou JPG.";
            header("location:cadastro.php?msg=".$msg);
        }
    }else {
        $nome_foto = 'null';
    }
    echo "<br>nome: ".$nome;
    echo "<br>nascimento: ".$nascimento;
    echo "<br>endereco: ".$endereco;
    echo "<br>cidade: ".$cidade;
    echo "<br>senha:".$senha;
    echo "<br>cpf: ".$cpf;    
    echo "<br>telefone: ".$telefone;
    echo "<br>celular: ".$celular;
    echo "<br>foto: ".$nome_foto;
    echo "<br>email: ".$email;
    echo "<br>estado: ".$estado;
    
   
    if(!isset($_POST["cliente"]) && !isset($_POST["prestador"])){
        $msg= "Escolha uma opção: cliente, prestador ou ambos.";
        header("location:cadastro.php?msg=".$msg);
    }else{
        $cliente= 0;
        $prestador= 0;
        if(isset($_POST["cliente"])){
            echo "<p>" .$sql="INSERT INTO tb_cliente (nome, data_nascimento, endereço, email, cpf, senha, telefone, celular, foto, cidade, fk_cidade, fk_estado, habilita, codigo) 
                VALUE ('$nome','$nascimento', '$endereco', '$email', '$cpf', '$senha', '$telefone', '$celular', '$nome_foto', $cidade, $id_cidade, $estado,'i', '$codigo' )";
           
            mysqli_query($conecta, $sql);
            $cliente= 1;
            
        }
        if(isset($_POST["prestador"])){
            echo "<p>" .$sql="INSERT INTO tb_prestador (nome, data_nascimento, endereço, email, cpf, senha, telefone, celular, foto, cidade, fk_cidade, fk_estado, habilita, codigo) 
            VALUE ('$nome','$nascimento', '$endereco', '$email', '$cpf', '$senha', '$telefone', '$celular', '$nome_foto', $cidade, $id_cidade, $estado,'i', '$codigo' )";
           
            mysqli_query($conecta, $sql);
            $prestador= 1;
        }       
                
    }
       
        if($cliente == 1 && $prestador==1){ // arrumar a mensagem que eles vão receber, tirar echo depois
            echo "Você escolheu cliente e prestador, seja bem-vindo! Você já pode navegar como cliente, como prestador aguarde 24 horas, seu cadastro está em análise.";
            $corpoMensagem="       
        <p>Clique no link abaixo para confirmar o seu cadastro: </p>
        http://localhost/Mywork/cadastro/confirma_cadastro.php?msg=".base64_encode($codigo);
            
        }else{
            if($cliente ==1){
                echo "Você escolheu cliente, seja bem-vindo!";
            }
            if($prestador==1){
                echo "Você escolheu prestador, aguarde 24h, seu cadastro está em análise.";
            }
        }

           
    
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
        $mail->Subject="confirmação de cadastro";              
        $mail->Body=$corpoMensagem;  
               
    
        if($mail->send()){
            $msg= base64_encode("E-mail enviado com sucesso.");        
            header("LOCATION:salvar_cadastro.php?msg=$msg");exit;
        }else{
            $msg= base64_encode("Falha ao enviar email, tente novamente mais tarde");
            header("LOCATION:../cadastro.php?msg=$msg");exit;             
        }   
    
    }catch(Exception $e){
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";    
    
    }

       
   
?>