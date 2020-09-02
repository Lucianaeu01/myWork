<?php 
$senha = $_POST["senha"];
$senhaConfirma  = $_POST["senha_confirma"];
include('../includes/conexaoMywork.php');
include("../includes/autenticacao.php");

if($_FILES["foto"]["error"]<>4) {
        $tipo = $_FILES["foto"]["type"];
        $extensao = explode(".",$_FILES["foto"]["name"]);
        $extensao = end($extensao);
        $nome_foto = sha1($_FILES["foto"]["tmp_name"] . time() . uniqid()) . "." . $extensao;
        
        move_uploaded_file($_FILES["foto"]["tmp_name"],"../fotos/".$nome_foto);
        
    }else {
        $nome_foto = $_POST["nome_foto"];
    }

if(!empty($_POST['habilita'])){
    $habilita = "a";
}else {
    $habilita = "i";
}
        
if($_POST) {
    
    if(!empty($senha)) {
        if($senha != $senhaConfirma) {
            $msg = base64_encode('As senhas digitadas não conferem! Por favor, digite novamente.');
            header('Location: index.php?msg='.$msg);
            exit;
        } else {
            $senha = sha1(md5($_POST["senha"]));
            $sqlSenha = "senha = '$senha',";
        }
    } else {
        $sqlSenha = "";
    }

    if(empty($_POST["pk_id"])) {

    $senha = sha1(md5($_POST["senha"]));    

    $sql = "INSERT INTO tb_prestador (nome,data_nascimento,cpf,email,senha,telefone,celular,fk_cidade,habilita,foto) VALUES    ('".$_POST["nome"]."','".$_POST["data_nascimento"]."','".$_POST["cpf"]."','".$_POST["email"]."','$senha','".$_POST["telefone"]."','".$_POST["celular"]."',".$_POST["cidade"].",'".$habilita."','$nome_foto');"; 

    $rs = mysqli_query($conecta,$sql);
    $id_prestador = mysqli_insert_id($conecta);
        

    $msg = base64_encode("Registro inserido com sucesso!");
    } else {
        $sql = "UPDATE tb_prestador SET 
        nome = '".$_POST["nome"]."',
        data_nascimento = '".$_POST["data_nascimento"]."',
        cpf = '".$_POST["cpf"]."',
        email = '".$_POST["email"]."',
        $sqlSenha
        telefone = '".$_POST["telefone"]."',
        celular = '".$_POST["celular"]."',
        fk_cidade = '".$_POST["cidade"]."',
        habilita = '".$habilita."',
        foto = '".$nome_foto."'
        WHERE pk_id = " . base64_decode($_POST["pk_id"]);

        $rs = mysqli_query($conecta,$sql);
        
        $id_prestador = base64_decode($_POST["pk_id"]);

        $msg = base64_encode("Registro atualizado com sucesso!");
        }
    
    if($rs) {
        mysqli_query($conecta,"DELETE FROM rl_prestador_servico WHERE fk_prestador = " . $id_prestador);
                $insertServico = "";
                $total = count($_POST["servico"]);
                for($i=0;$i<$total;$i++) {
                    $insertServico.= "($id_prestador," . $_POST["servico"][$i] . "),";
                }

                $servico = "INSERT INTO rl_prestador_servico (fk_prestador,fk_servico) VALUES ";
                $servico.= $insertServico; 
                $rs = mysqli_query($conecta,substr($servico,0,-1));
        }
    
}else{
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
}


header('Location: index.php?msg='.$msg);
?>