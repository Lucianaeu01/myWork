<?php
 include("../area-administrativa/includes/conexaoMywork.php"); 
 
 $codigo=base64_decode($_GET["msg"]);

if(isset($_GET["msg"])){
   
    $sql="SELECT * FROM tb_cliente WHERE codigo= '$codigo'";
    $rs=mysqli_query($conecta, $sql);
    if(mysqli_num_rows($rs)!=0){
        $sql="UPDATE tb_cliente SET codigo= NULL,habilita='a' WHERE codigo = '$codigo' ";
        mysqli_query($conecta,$sql);
        
        $msg=base64_encode("Cadastro confirmado com sucesso!");
        

    }
    $sql="SELECT * FROM tb_prestador WHERE codigo = '$codigo'";
    $rs= mysqli_query($conecta, $sql);
    if(mysqli_num_rows($rs)!=0){        
       $sql="UPDATE tb_prestador SET codigo= NULL WHERE codigo = '$codigo' ";
       mysqli_query($conecta,$sql);

        $msg=base64_encode("Cadastro em análise, aguarde dois dias úteis.");
       
    }       
   
} else{
    $msg=base64_encode("Link inválido, tente fazer o cadastro novamente.");
    
    } 

header("location:../index.php?msg=$msg");
       
    

 

?>
