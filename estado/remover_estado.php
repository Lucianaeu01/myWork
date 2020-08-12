<?php 
if(!empty($_POST["pk_id"])) {
    include('../includes/conexaoMywork.php');
    $rs = "DELETE FROM tb_estado WHERE pk_id = ". $_POST["pk_id"];
    
    mysqli_query($conecta,$rs);
    
    if($rs) {
        $msg = base64_encode("Registro removido com sucesso!");
    } else {
        $msg = base64_encode("Falha ao tentar remover o registro! Tente novamente mais tarde.");
    }
}

header('Location: lista_estado.php?msg='.$msg);
?>