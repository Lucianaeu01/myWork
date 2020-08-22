<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    include("../includes/autenticacao.php");
    
    if(empty($_POST["pk_id"])) {
        
        $sql = "INSERT INTO tb_cidade (nome_cidade, fk_estado) VALUES ('".$_POST["cidade"]."',".$_POST["estado"].");";
    
        mysqli_query($conecta,$sql);
   
        $msg = base64_encode("Registro inserido com sucesso!");
    
    } else {
        $sql = "UPDATE tb_cidade SET 
        nome_cidade = '".$_POST["cidade"]."',
        fk_estado = '".$_POST["estado"]."'
        WHERE pk_id = " . base64_decode($_POST["pk_id"]);

        $rs = mysqli_query($conecta,$sql);

        $msg = base64_encode("Registro atualizado com sucesso!");
        } 
}else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
}
header('Location: index.php?msg='.$msg);
?>
