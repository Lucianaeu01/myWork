<?php
 include("../area-adiministrativa/includes/conexaoMywork.php");  

 if(isset($_POST)){
        //recuperar os valores dos objetos de formulario
        $nome=$_POST["nome"];
        $nascimento=$_POST["data_nascimento"];
        $endereco=$_POST["endereco"];
        $cidade=$_POST["cidade"];
        $senha=$_POST["senha"];
        $senhaConfirma=$_POST["senha_confirma"];
        $cpf=$_POST["cpf"];
        $foto=$_POST["foto"];
        $telefone=$_POST["telefone"];
        $celular=$_POST["celular"];        
        

     //validar senha
     if(isset($_POST["senha"])){        
         if($senha==$senhaConfirma){
            $senha = sha1(md5($_POST["senha"]));
            $sqlSenha = "senha = '$senha',";          
           
        } else {
            $msg = base64_encode("As senhas digitadas são diferentes! Por favor, digite novamente.");
            header("location:cadastro.php");
            exit;  
                      
        }
    }        
   
    if(isset($_POST["cliente"])){
        $cliente=$_POST["cliente"];
       echo $sql="INSERT INTO tb_cliente(nome,data_nascimento,cpf,email,senha,telefone,celular,endereco,fk_cidade,foto,habilita) VALUES ('".$nome."','".$nascimento."','".$cpf."','".$email."','$senha','".$telefone."','".$celular."','".$endereco."',".$cidade.",'".$foto."','i');";exit;
        mysqli_query($conecta,$sql);
    }
        
    if(isset($_POST["prestador"])){
        $prestador=$_POST["prestador"];
        $sql="INSERT INTO tb_prestador(nome,data_nascimento,cpf,email,senha,telefone,celular,endereco,fk_cidade,foto,habilita) VALUES ('".$nome."','".$nascimento."','".$cpf."','".$email."','$senha','".$telefone."','".$celular."','".$endereco."',".$cidade.",'".$foto."','i');";
        mysqli_query($conecta,$sql);
    }  
        $msg= base64_encode("Cadastro efetuado com sucesso!");
        header("location:confirma_cadastro.php");
    }
?>