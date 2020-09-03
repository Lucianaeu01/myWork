<?php
include("includes/conexaoMywork.php");
include('includes/autenticacao.php');

// buscando as fotos de determinado serviço no banco
$idservico = 1;                      //codigo do serviço excluido ou alterado para apagar a foto no servidor
$op= "update";
$consulta = mysqli_query($conecta,"SELECT foto FROM tb_servico WHERE pk_id = '".$idservico."'");

//verificar se existe o registro desse serviço
if (mysqli_num_rows($consulta) > 0) {
    
     $row = mysqli_fetch_object($consulta);
     $nomefotoantigo= $row->foto;
        if($op == "update"){
            
            $sql = "UPDATE tb_servico SET 
            pk_id = '".$_POST["pk_id"]."',
            servico = '".$_POST["servico"]."',
            fk_categoria = '".$_POST["fk_categoria"]."',
            habilita = '".$_POST["habilita"]."',
            foto = '".$_POST["foto"]."',        
           
            WHERE pk_id = " . base64_decode($_POST["pk_id"]);           //alterar os dados do serviço pk_id, servico, habilita, fk_categoria, foto
            
            //desenvolver codigo de atualização para o banco de dados e mover o arquivo novo para pasta de imagens            
            $rs = mysqli_query($conecta,$sql);
        
            $msg = base64_encode("Registro atualizado com sucesso!");
        }
        if($op == "delete"){
           //desenvolver sql para deletar o registro da base de dados 

        }
        if(mysqli_query($conecta, $sql)){       
            if(!empty($nomefotoantigo)){
                unlink("foto/".$nomefotoantigo);
            }
            //redirecionar 
        }else{
            echo("Erro de sintax")
        }
        echo ("Erro ao deletar $consulta");
    
}else
        echo ("Registro não encontrado");
}
?>

