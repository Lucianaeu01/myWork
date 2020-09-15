<?php 

include('../includes/conexaoMywork.php');


if($_POST) {
    $senha = $_POST["novaSenha"];
    $senhaConfirma  = $_POST["confirmaSenha"];

    if(!empty($senha)) {
        if($senha != $senhaConfirma) {
            $msg = base64_encode('As senhas digitadas não conferem! Por favor, digite novamente.');
            header('Location: redefinir_senha_final.php?msg='.base64_encode($msg). '&id='.base64_encode($_POST["id"]).'&tb='.base64_encode($_POST["tabela"]));
            exit;
        } else {
            $senha = sha1(md5($_POST["novaSenha"]));           
            $sql1="UPDATE tb_".$_POST["tabela"]." SET senha='$senha', codigo = NULL WHERE pk_id=".$_POST["id"];           
            mysqli_query($conecta,$sql1);
            if($_POST("tabela") == "administrador"){
            header('Location: ../login_adm.php?msg='.base64_encode('Senha alterada com sucesso!'));
           }else{
           header('Location: ../login.php?msg='.base64_encode('Senha alterada com sucesso!'));
           }
           exit;
        }
    }else{
        header('Location: redefinir_senha_codigo.php?msg='.base64_encode('Senha não confere, insira o código novamente e reinicie todo o processo.'));
           exit;
    }
}else{
    header('Location: ../login.php?msg='.base64_encode('Acesso indevido. Faça login novamente.'));
    exit;
}

