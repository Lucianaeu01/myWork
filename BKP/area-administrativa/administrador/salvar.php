<?php 
include('../includes/conexaoMywork.php');
include("../includes/autenticacao_adm.php");
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
                
                $sql = "INSERT INTO tb_administrador (nome,email,senha,habilita) VALUES 
                ('".$_POST["nome"]."','".$_POST["email"]."','$senha','".$habilita."');";
                
                mysqli_query($conecta,$sql);
                
                echo $msg = base64_encode("Registro inserido com sucesso!");
            } else {
                $sql = "UPDATE tb_administrador SET 
                nome = '".$_POST["nome"]."',
                email = '".$_POST["email"]."',
                $sqlSenha
                habilita = '".$habilita."',
                WHERE pk_id = " . base64_decode($_POST["pk_id"]);
                
                $rs = mysqli_query($conecta,$sql);
                
                $msg = base64_encode("Registro atualizado com sucesso!");
            }  
        }else{
            $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
        }
header('Location: lista_adm.php?msg='.$msg);
?>