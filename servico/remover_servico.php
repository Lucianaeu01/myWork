<?php 
if(!empty($_POST["pk_id"])) {
    include('../includes/conexaoMywork.php');
    include('../includes/autenticacao.php');
    $rs = "DELETE FROM tb_servico WHERE pk_id = ". $_POST["pk_id"];
    
    mysqli_query($conecta,$rs);
    
    if($rs) {
        $msg = base64_encode("Registro removido com sucesso!");
    } else {
        $msg = base64_encode("Falha ao tentar remover o registro! Tente novamente mais tarde.");
    }
}

header('Location: index_servico.php?msg='.$msg);
?>