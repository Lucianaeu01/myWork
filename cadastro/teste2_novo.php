<?php 
 include("../area-administrativa/includes/conexaoMywork.php");

if(!empty($_POST["email"])){
    $email=$_POST["email"];

    $sql="SELECT * FROM tb_cliente WHERE email= '$email'";
    $rs=mysqli_query($conecta,$sql);
    if(mysqli_num_rows($rs)>=1){
        echo "e-mail informado já esta em uso na plataforma!";
    }else{
        echo "e-mail informado pode ser utilizado!";
    }
}else{
    echo "";
}

?>