<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    if(!empty($_POST['habilita'])){
        $habilita = "a";
    }else{
        $habilita = "i";
    }
    if(empty($_POST["pk_id"])) {
        $sql = "INSERT INTO tb_categoria (categoria,habilita) VALUES ('".$_POST["categoria"]."','".$habilita."');";
        
        mysqli_query($conecta,$sql);
    
        $msg = base64_encode("Registro inserido com sucesso!");
    
    }else {
    $sql = "UPDATE tb_categoria SET 
        categoria = '".$_POST["categoria"]."',
        habilita = '".$habilita."'
        WHERE pk_id = " . base64_decode($_POST["pk_id"]);
        

        $rs = mysqli_query($conecta,$sql);

        $msg = base64_encode("Registro atualizado com sucesso!"); 
    }
}else{
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
}
header('Location: index.php?msg='.$msg);
?>