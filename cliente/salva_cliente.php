<?php 
if($_POST) {
    include('includes/conexaoMywork.php');
    
    $sql = "INSERT INTO tb_cliente (nome,data_nascimento,cpf,email,telefone,celular,fk_cidade) VALUES    ('".$_POST["nome"]."','".$_POST["data_nascimento"]."','".$_POST["cpf"]."','".$_POST["email"]."','".$_POST["telefone"]."','".$_POST["celular"]."',".$_POST["cidade"].");";
    
    mysqli_query($conecta,$sql);

    if ($sql) {   
    $msg = base64_encode("Registro inserido com sucesso!");
    } else {
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde."); 
    }
}
header('Location: lista_clientes.php?msg='.$msg);
?>