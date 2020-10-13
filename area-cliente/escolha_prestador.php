<?php 
include("includes/conexaoMywork.php");

if($_GET["id"]){
    $sql = "SELECT * FROM tb_prestador WHERE pk_id = ".$_GET["id"];
    $rs = mysqli_query($conecta,$sql);
    if(mysqli_num_rows($rs)>0) {
        $row = mysqli_fetch_object($rs);
    }
}else{
    $msg = base64_encode("Prestador não encontrado");
    header("location: agendamento.php?msg=$msg");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dados Agendamento</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<style>
    body {
        padding-top: 15px;
        background-color: gainsboro;
    }

    .pag {
        position: absolute;
        margin: auto;
        width: 950px;
        height: 800px;
        background-color: white;
        border: solid black 10px;
        top: 0; 
        bottom: 0;
        left: 0;
        right: 0;
    }

    .conteudo {
        padding: 25px;
    }

    .pf {
        position: relative;
        height: 200px;
        width: 150px;
        float: left;
    }

    .pf img {
        border: solid red 2px;
    }

    .top {
        position: relative;
        width: 600px;
        float: left;
        padding-left: 25px;
        padding-top: 3px;
    }

    .av {
        position: relative;
        width: 150px;
        text-align: center;
        float: left;
    }

    .spc {
        position: relative;
        width: 650px;
        float: left;
    }

    .st {
        position: relative;
        width: 900px;
        float: left;
        text-align: center;

    }

    .box {
        position: relative;
        width: 880px;
        height: 150px;
        border: solid black 1px;
        float: left;
    }

    .note {
        position: relative;
        width: 100px;
        height: 150px;
        padding-top: 35px;
        padding-left: 15px;
        float: left;
    }

    .checkbox1 {
        position: relative;
        width: 192px;
        height: 150px;
        float: left;
        padding-top: 35px;
        padding-left: 15px;
        font-size: 25px;
        font-weight: bolder
    }

    .calendario {
        position: relative;
        width: 100px;
        height: 150px;
        padding-top: 35px;
        padding-left: 25px;
        float: left;
    }

    .data {
        position: relative;
        width: 192px;
        height: 150px;
        float: left;
        padding-top: 35px;
        font-size: 25px;
        text-align: center;
        font-weight: bolder
    }

    .data input {
        outline: none !important;
        border: none !important;
    }

    input::-webkit-calendar-picker-indicator {
        display: none;
    }

    .checkbox2 {
        position: relative;
        width: 310px;
        height: 150px;
        float: left;
        text-align: center;
        padding-top: 35px;
        margin-right: -20px;
    }

    p {
        font-size: 25px;
        font-weight: bolder;
    }

    textarea {
        width: 880px;
        float: left;
    }

</style>

<body>
    <div class="pag">
        <div class="conteudo">
            <h1 style=text-align:center;>Confirmação do Agendamento</h1><br>
            <div class="pf">
                <img src="../area-administrativa/fotos/<?php echo base64_decode($row->foto) ?>" height="200" width="150">
            </div>
            <div class="top">
                <h2>Nome do prestador:</h2>
                <h3><?php echo base64_decode($row->nome ?>)</h3><br>
                <h2>Serviço solicitado:</h2>
                <h3><?php echo base64_decode($_GET["sv"] ?>)</h3>
            </div>
            <div class="av">
                <h4>Avaliação</h4>
                <h5>8,5</h5>
            </div>
            <div class="spc"></div>
            <div class="st">
                <h3>Confirmação da Solicitação e agendamento</h3>
            </div>
            <div class="box">
                <div class="note">
                    <img src="../imagens/agenda.png" width="70" height="70">
                </div>
                <div class="checkbox1">
                    <input type="checkbox"> Confirmação do prestador
                </div>
                <div class="calendario">
                    <img src="../imagens/calendario.png" width="70" height="70">
                </div>
                <div class="data">
                    <label for="data" style="padding-laft:20px;">Data:&nbsp;&nbsp;&nbsp;</label><br>
                    <input type="date" name="data">
                </div>
                <div class="checkbox2">
                    <p>Período</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Manhã</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Tarde</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                        <label class="form-check-label" for="inlineRadio3">Noite</label>
                    </div>
                </div>
            </div>
            <div class="st">
                <h3>Descrição do problema</h3>
            </div>
            <div class="msg">
                <textarea rows="6"></textarea>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../css/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
</body>

</html>
