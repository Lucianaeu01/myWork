<?php
 include("../area-administrativa/includes/conexaoMywork.php");  

 if(isset($_POST)){
        //recuperar os valores dos objetos de formulario
        $nome=$_POST["nome"];
        $nascimento=$_POST["data_nascimento"];
        $endereco=$_POST["endereco"];
        $cidade=$_POST["cidade"];
        $senha=$_POST["senha"];
        $senhaConfirma=$_POST["senha_confirma"];
        $cpf=$_POST["cpf"];
        $foto=$_POST["foto"];        
        $celular=$_POST["celular"];        
                 

     //validar senha
     if(isset($_POST["senha"])){        
         if($senha==$senhaConfirma){
            $senha = sha1(md5($_POST["senha"]));
            $sqlSenha = "senha = '$senha',";          
           
        } else {
            $msg = base64_encode("As senhas digitadas são diferentes! Por favor, digite novamente.");
            header("location:cadastro.php");
            exit;  
                      
        }
    }      
        $sql="SELECT * FROM tb_cidade WHERE nome_cidade= $cidade";
        $rs=mysqli_query($conecta,$sql);
        if(mysqli_num_rows($rs)>=1){
            $row=mysqli_fetch_object($rs);
            $id_cidade=$row->pk_id;
            $cidade='null';
        }else{
            $id_cidade='null';
        }
   
    //recuperar telefone
    if(empty($_POST["telefone"])){
        $telefone='null';
        
    }else{
        $telefone=$_POST["telefone"];
    }
    
   //recuperar foto se houver alem de recuperar, mudar nome da foto e mover para o servidor
    if($_FILES["foto"]["error"]<>4) {
        $tipo = $_FILES["foto"]["type"];
        $extensao = explode(".",$_FILES["foto"]["name"]);
        $extensao = end($extensao);
        $nome_foto = sha1($_FILES["foto"]["tmp_name"] . time() . uniqid()) . "." . $extensao;
        
        move_uploaded_file($_FILES["foto"]["tmp_name"],"../fotos/".$nome_foto);
        
    }else {
        $nome_foto = 'null';
    }
    echo "<br>nome: ".$nome;
    echo "<br>nascimento: ".$nascimento;
    echo "<br>endereco: ".$endereco;
    echo "<br>cidade: ".$cidade;
    echo "<br>senha:".$senha;
    echo "<br>cpf: ".$cpf;
    echo "<br>cliente: ".$cliente;
    echo "<br>prestador:".$prestador;
    echo "<br>telefone: ".$telefone;
    echo "<br>celular: ".$celular;
    echo "<br>foto: ".$nome_foto;
    
   
    if(!isset($_POST["cliente"]) && !isset($_POST["prestador"])){
        $msg= "Escolha uma opção: cliente, prestador ou ambos.";
        header("location:cadastro.php");
    }else{
        if(isset($_POST["cliente"])){
            $sql="INSERT INTO tb_cliente (nome, data_nascimento, endereco, email, cpf, senha, telefone, celular, foto, cidade,)";
            $cliente=$_POST["cliente"];
        }
        if(isset($_POST["prestador"])){
            $prestador=$_POST["prestador"];
        }
    }
    
}   
?>