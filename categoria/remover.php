<?php 
if(!empty($_POST["pk_id"])) {
    include('../includes/conexaoMywork.php');
    include('../includes/autenticacao.php');
    
    $consulta = "SELECT foto FROM tb_prestador WHERE pk_id = ". $_POST["pk_id"];
    
    $query = mysqli_query($conecta,$consulta);
    $row = mysqli_fetch_object($query);
    unlink('../fotos/'.$row->foto);
    
    $rs = "DELETE FROM tb_categoria WHERE pk_id = ". $_POST["pk_id"];
    
    mysqli_query($conecta,$rs);
    
    if($rs) {
        $msg = base64_encode("Registro removido com sucesso!");
    } else {
        $msg = base64_encode("Falha ao tentar remover o registro! Tente novamente mais tarde.");
    }
}

header('Location: index.php?msg='.$msg);
?>