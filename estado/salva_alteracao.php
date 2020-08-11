<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    
    $sql = "UPDATE tb_estado SET nome_estado = '".$_POST["estado"]."', UF = '".$_POST["uf"]."' WHERE pk_id = ".$_POST["pk_id"].";"; 
   
    mysqli_query($conecta,$sql);

    if ($sql) {   
    $msg = base64_encode("Registro alterado com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar alterar o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_estado.php?msg='.$msg);
?>