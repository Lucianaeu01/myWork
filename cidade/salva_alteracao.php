<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    
    $sql = "UPDATE tb_cidade SET nome_cidade = '".$_POST["cidade"]."', fk_estado = ".$_POST["uf"]." WHERE pk_id = ".$_POST["pk_id"].";"; 
    
    mysqli_query($conecta,$sql);

    if ($sql) {   
    $msg = base64_encode("Registro alterado com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar alterar o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_cidade.php?msg='.$msg);
?>