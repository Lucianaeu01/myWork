<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    
    $sql = "INSERT INTO tb_estado (nome_estado,UF) VALUES ('".$_POST["estado"]."','".$_POST["uf"]."');";
    
    mysqli_query($conecta,$sql);

    if ($sql) {   
    $msg = base64_encode("Registro inserido com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_estado.php?msg='.$msg);
?>