<?php 
if($_POST) {
    include('../includes/conexaoMywork.php');
    
    $senha = sha1(md5($_POST["senha"]));    
    
    if(empty($_POST["pk_id"])) {
        
    $sql = "INSERT INTO tb_cliente (nome,data_nascimento,cpf,email,senha,telefone,celular,fk_cidade) VALUES    ('".$_POST["nome"]."','".$_POST["data_nascimento"]."','".$_POST["cpf"]."','".$_POST["email"]."','$senha','".$_POST["telefone"]."','".$_POST["celular"]."',".$_POST["cidade"].");";
    
    mysqli_query($conecta,$sql);
 
    $msg = base64_encode("Registro inserido com sucesso!");
    } else {
        $sql = "UPDATE tb_cliente SET 
        nome = '".$_POST["nome"]."',
        data_nascimento = '".$_POST["data_nascimento"]."',
        cpf = '".$_POST["cpf"]."',
        email = '".$_POST["email"]."',
        senha = '$senha',
        telefone = '".$_POST["telefone"]."',
        celular = '".$_POST["celular"]."',
        fk_cidade = '".$_POST["cidade"]."'
        WHERE pk_id = " . base64_decode($_POST["pk_id"]);

        $rs = mysqli_query($conecta,$sql);

        $msg = base64_encode("Registro atualizado com sucesso!");
        }  
    }else{
    $msg = base64_encode("Falha ao tentar inserir o registro! Tente novamente mais tarde.");
}
header('Location: lista_clientes.php?msg='.$msg);
?>