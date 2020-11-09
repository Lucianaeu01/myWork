<?php
 include("../area-administrativa/includes/conexaoMywork.php");  

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste - Consulta banco jQuery</title>
    <style>
        #resposta{
            display: none;
            width:390px;
            height:20px;
            border:1px solid;
            border-radius: 3px;
            padding-left:10px;
            margin-bottom:10px;
        }
        form{
            display:flex;
            flex-direction:column;
            width:400px;
            padding:20px;
            border:1px solid #CCCCCC;
            border-radius:15px;
        }
    
    </style>  

</head>
<body class="bg-dark" >
<h1 onclick="ola();">Teste - consulta banco jQuery</h1>
<form method="POST" action="" id="formData">
<input type="email" name="email" id="email" required/>
<input type="hidden" id="hidden" name="hidden" value="teste"/>
<div id="resposta"></div>
<button id="button">Enviar</button>
</form>
// linha de comentário
/* bloco de comentário
EXEMPLOS
function ola(){​​
    alert("evento click acionado!")
}​​
$("#email").click(function(){​​
    console.log("clicou no input email...")
}​​);
*/

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script>
   
    $("#email").change(function(){
        
        var dados=$("#formData").serialize();
        $.post("teste2_novo.php",dados,function(retorna){
            $("#resposta").slideDown("slow").html(retorna);
            $("#resposta").css('display','table-cell');
            $("#resposta").css('vertical-align','middle');
            if(retorna == 'e-mail informado pode ser utilizado!'){
                $("#resposta").css('background-color','lightgreen');
                $("#resposta").css('color','darkgreen');
                $("#resposta").css('border-color','darkgreen');
                $("#button").attr('disabled',false);
            }else{
                if(retorna !=''){
                    $("#resposta").css('background-color','plum');
                    $("#resposta").css('color','brown');
                    $("#resposta").css('border-color','brown');
                    $("#button").attr('disabled', true);
                }else{
                    $("#resposta").css('display','none');
                    $("button").attr('disabled',false);
                }
            }
        });
    });
    
    </script>    
    
</body>
</html>