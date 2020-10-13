<?php
include('includes/conexaoMywork.php');

if($_REQUEST["ref1"]) {
    $sql = "SELECT p.pk_id, nome, email, TRUNCATE(DATEDIFF(NOW(),data_nascimento)/365.25,0) AS idade, telefone, celular, nome_cidade, p.foto, servico FROM tb_prestador p
            INNER JOIN tb_cidade c ON c.pk_id = p.fk_cidade
            INNER JOIN rl_prestador_servico rl ON fk_prestador=p.pk_id 
            INNER JOIN tb_servico s ON fk_servico=s.pk_id
            WHERE s.pk_id =".$_REQUEST["ref1"];
    $rs = mysqli_query($conecta,$sql);
    
    if(mysqli_num_rows($rs) > 0) {
        while($row = mysqli_fetch_object($rs)) {
            echo '<tr onclick="location.href=\'escolha_prestador.php?sv='.base64_encode($row->servico).'\&id='.base64_encode($row->pk_id).'\'">
                  <td><img src="../area-administrativa/fotos/'.base64_encode($row->foto).'" height="80"></td>
                  <td class="centro">'.$row->nome.'</td>
                  <td class="centro">'.$row->email.'</td>
                  <td class="centro">'.$row->idade.'</td>
                  <td class="centro">'.$row->telefone.'</td>
                  <td class="centro">'.$row->celular.'</td>
                  <td class="centro">'.$row->nome_cidade.'</td></tr>
                  ';
        }
    } else {
        echo '<option value=""> Nenhum prestador encontrado </option>';
    }
}
?>