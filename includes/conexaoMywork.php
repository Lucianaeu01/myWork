<?php

$host = "192.185.216.45";
$user = "glauc751_mywork";
$pass = "myWork@Sena2020";
$dbname = "glauc751_mywork";

$conecta = mysqli_connect($host,$user,$pass);

if($conecta) {
    mysqli_select_db($conecta,$dbname);
} else {
    echo "ERRO: Falha ao conectar na base de dados!";
}

?>