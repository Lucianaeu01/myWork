<?php 
$senha = $_POST["senha"];
$senhaConfirma  = $_POST["senha_confirma"];
include('../includes/conexaoMywork.php');
include("../includes/autenticacao.php");

if(!empty($_POST['habilita'])){
    $habilita = "a";
}else {
    $habilita = "i";
}
if ($senha<>"") {
    if ($senha==$senhaConfirma) {
        
        if($_POST) {
            
            if(empty($_POST["pk_id"])) {
                
            $senha = sha1(md5($_POST["senha"]));    
                
            $sql = "INSERT INTO tb_prestador (nome,data_nascimento,cpf,email,senha,telefone,celular,fk_cidade,habilita) VALUES    ('".$_POST["nome"]."','".$_POST["data_nascimento"]."','".$_POST["cpf"]."','".$_POST["email"]."','$senha','".$_POST["telefone"]."','".$_POST["celular"]."',".$_POST["cidade"].",'".$habilita."');"; 
            
            mysqli_query($conecta,$sql);
        
            $msg = base64_encode("Registro inserido com sucesso!");
            } else {
                $senha = sha1(md5($_POST["senha"]));
                $sql = "UPDATE tb_prestador SET 
                nome = '".$_POST["nome"]."',
                data_nascimento = '".$_POST["data_nascimento"]."',
                cpf = '".$_POST["cpf"]."',
                email = '".$_POST["email"]."',
                senha = '$senha',
                telefone = '".$_POST["telefone"]."',
                celular = '".$_POST["celular"]."',
                fk_cidade = '".$_POST["cidade"]."',
                habilita = '".$habilita."'
                WHERE pk_id = " . base64_decode($_POST["pk_id"]);
        
                $rs = mysqli_query($conecta,$sql);
        
                $msg = base64_encode("Registro atualizado com sucesso!");
                }  
        }else{
            $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
        }
    }else {
    $msg = base64_encode("As senhas não são iguais!");
    header('Location: inserir_prestador.php?msg='.$msg);
    exit;
    }
}elseif ($senha=="" && $senhaConfirma=="") {
            $sql = "UPDATE tb_prestador SET 
            nome = '".$_POST["nome"]."',
            data_nascimento = '".$_POST["data_nascimento"]."',
            cpf = '".$_POST["cpf"]."',
            email = '".$_POST["email"]."',
            telefone = '".$_POST["telefone"]."',
            celular = '".$_POST["celular"]."',
            fk_cidade = '".$_POST["cidade"]."',
            habilita = '".$habilita."'
            WHERE pk_id = " . base64_decode($_POST["pk_id"]); 
    
            $rs = mysqli_query($conecta,$sql);
    
            $msg = base64_encode("Registro atualizado com sucesso!");
}

header('Location: index.php?msg='.$msg);
?>