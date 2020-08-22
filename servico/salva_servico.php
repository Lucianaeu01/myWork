<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    
    if(empty($_POST["pk_id"])) {
        
        $sql = "INSERT INTO tb_servico (servico, fk_categoria) VALUES ('".$_POST["servico"]."',".$_POST["categoria"].");";
    
        mysqli_query($conecta,$sql);
   
        $msg = base64_encode("Registro inserido com sucesso!");
    
    } else {
        $sql = "UPDATE tb_servico SET 
        servico = '".$_POST["servico"]."',
        fk_categoria = '".$_POST["categoria"]."'
        WHERE pk_id = " . base64_decode($_POST["pk_id"]);

        $rs = mysqli_query($conecta,$sql);

        $msg = base64_encode("Registro atualizado com sucesso!");
        } 
}else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
}
header('Location: index.php?msg='.$msg);
?>
