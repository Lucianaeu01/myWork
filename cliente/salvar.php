<?php 
include('../includes/conexaoMywork.php');
include("../includes/autenticacao.php");
$senha = $_POST["senha"];
$senhaConfirma  = $_POST["senha_confirma"];
if($_FILES["foto"]["error"]<>4) {
        $tipo = $_FILES["foto"]["type"];
        $extensao = explode(".",$_FILES["foto"]["name"]);
        $extensao = end($extensao);
        $nome_foto = sha1($_FILES["foto"]["tmp_name"] . time() . uniqid()) . "." . $extensao;
        
        move_uploaded_file($_FILES["foto"]["tmp_name"],"../fotos/".$nome_foto);
        
    }else {
        $nome_foto = $_POST["nome_foto"];
    }
if(!empty($senha)) {
        if($senha != $senhaConfirma) {
            $msg = base64_encode('As senhas digitadas não conferem! Por favor, digite novamente.');
            header('Location: inserir.php?msg='.$msg. '&id='.$_POST["pk_id"]);
            exit;
        } else {
            $senha = sha1(md5($_POST["senha"]));
            $sqlSenha = "senha = '$senha',";
        }
    } else {
        $sqlSenha = "";
    }
        
        if($_POST) {
            if(!empty($_POST['habilita'])){
                $habilita = "a";
            }else {
                $habilita = "i";
            }
            
            if(empty($_POST["pk_id"])) {
            $senha = sha1(md5($_POST["senha"]));    
                
                $sql = "INSERT INTO tb_cliente (nome,data_nascimento,cpf,email,senha,telefone,celular,fk_cidade,habilita,foto) VALUES   ('".$_POST["nome"]."','".$_POST["data_nascimento"]."','".$_POST["cpf"]."','".$_POST["email"]."','$senha','".$_POST["telefone"]."','".$_POST["celular"]."',".$_POST["cidade"].",'".$habilita."','".$nome_foto."');";
                
                mysqli_query($conecta,$sql);
                
                echo $msg = base64_encode("Registro inserido com sucesso!");
            } else {
                $sql = "UPDATE tb_cliente SET 
                nome = '".$_POST["nome"]."',
                data_nascimento = '".$_POST["data_nascimento"]."',
                cpf = '".$_POST["cpf"]."',
                email = '".$_POST["email"]."',
                $sqlSenha
                telefone = '".$_POST["telefone"]."',
                celular = '".$_POST["celular"]."',
                fk_cidade = ".$_POST["cidade"].",
                habilita = '".$habilita."',
                foto = '".$nome_foto."'
                WHERE pk_id = " . base64_decode($_POST["pk_id"]);
                
                $rs = mysqli_query($conecta,$sql);
                
                $msg = base64_encode("Registro atualizado com sucesso!");
            }  
        }else{
            $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
        }
    }else {
    
}

header('Location: index.php?msg='.$msg);
?>