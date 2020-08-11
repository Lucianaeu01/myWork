<?php 
if($_POST) {
    include('includes/conexaoMywork.php');
    
   $up = "UPDATE tb_cliente SET nome = '".$_POST["nome"]."', data_nascimento = '".$_POST["data_nascimento"]."', email = '".$_POST["email"]."', telefone = '".$_POST["telefone"]."', celular = '".$_POST["telefone"]."', fk_cidade = ".$_POST["cidade"]." WHERE pk_id = ".$_POST["pk_id"];
    
    mysqli_query($conecta,$up);

    if ($up) {   
    $msg = base64_encode("Registro alterado com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar alterar o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_clientes.php?msg='.$msg);
?>