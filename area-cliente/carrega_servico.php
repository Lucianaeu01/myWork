<?php
include('includes/conexaoMywork.php');

if($_REQUEST["ref"]) {
    $sql = "SELECT pk_id, servico FROM tb_servico WHERE fk_categoria = " . $_REQUEST["ref"];
    $rs = mysqli_query($conecta,$sql);
    
    if(mysqli_num_rows($rs) > 0) {
        echo '<option value="">-- Escolha um serviço --</option>';
        while($row = mysqli_fetch_object($rs)) {
            echo '<option value="'.$row->pk_id.'"> '.$row->servico.' </option>';
        }
    } else {
        echo '<option value=""> Nenhum serviço encontrado </option>';
    }
}
?>
