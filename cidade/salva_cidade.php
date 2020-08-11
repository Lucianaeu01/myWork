<?php 
if($_POST) {
    include('includes/conexaoMywork.php');
    
    $sql = "INSERT INTO tb_cidade (nome_cidade, fk_estado) VALUES ('".$_POST["cidade"]."',".$_POST["uf"].");";
    
    mysqli_query($conecta,$sql);

    if ($sql) {   
    $msg = base64_encode("Registro inserido com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_cidade.php?msg='.$msg);
?>