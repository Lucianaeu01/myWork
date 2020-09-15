<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    include('../includes/autenticacao.php');
    
    if($_FILES["foto"]["error"]<>4) {
        $tipo = $_FILES["foto"]["type"];
        $extensao = explode(".",$_FILES["foto"]["name"]);
        $extensao = end($extensao);
        $nome_foto = sha1($_FILES["foto"]["tmp_name"] . time() . uniqid()) . "." . $extensao;

        move_uploaded_file($_FILES["foto"]["tmp_name"],"../fotos/".$nome_foto);

    }else {
        $nome_foto = $_POST["nome_foto"];
    }
    
    if(!empty($_POST["or"])){
        if(empty($nome_foto)){
            $nome_foto = "Null";    
        }else{
            
        }
        $sql = "INSERT INTO tb_servico (servico, fk_categoria, foto) VALUES ('".$_POST["servico"]."',".$_POST["categoria"].",'$nome_foto');";
        
        mysqli_query($conecta,$sql);

        $msg = base64_encode("Registro inserido com sucesso!"); 

        header("Location: ../prestador/inserir.php?msg=$msg");
        
    }else {
        
        if(!empty($_POST['habilita'])){
            $habilita = "a";
        }else{
            $habilita = "i";
        }    

        if(empty($_POST["pk_id"])) {

            $sql = "INSERT INTO tb_servico (servico, fk_categoria, habilita, foto) VALUES ('".$_POST["servico"]."',".$_POST["categoria"].",'".$habilita."','$nome_foto');";

            mysqli_query($conecta,$sql);

            $msg = base64_encode("Registro inserido com sucesso!");

        } else {
            $sql = "UPDATE tb_servico SET 
            servico = '".$_POST["servico"]."',
            fk_categoria = '".$_POST["categoria"]."',
            habilita = '".$habilita."',
            foto = '".$nome_foto."'
            WHERE pk_id = " . base64_decode($_POST["pk_id"]);


            $rs = mysqli_query($conecta,$sql);

            $msg = base64_encode("Registro atualizado com sucesso!");
            
            }
            header('Location: index.php?msg='.$msg);
    }
}else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
    header('Location: index.php?msg='.$msg);
}


?>
