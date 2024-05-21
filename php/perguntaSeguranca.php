<?php

require "conexao.php";
require "funcoes.php";
$perguntaSeguranca = $_SESSION['perguntaSegurança'];
$perguntaAleatoria = $_SESSION['perguntaAleatoria'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pergunta de Segurança</title>
    <link rel="icon" type="image/x-icon" href="../favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../estilosPhp.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../principal/index.html"><img src="../imagens/logo-hdr.png" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../principal/index.html">Home</a></li>
                        <li><a href="../2FA/2FA.html">2FA</a></li>
                        <li><a href="../mascara/numeroMascara.html">Numero de Máscara</a></li>
                        <li><a href="../cpaas/cpaas.html">CPAAS</a></li>
                        <li><a href="../google_verified/google_verified.html">Google-Verified</a></li>
                        <li><a href="../sms_programavel/sms_programavel.html">Sms-Programável</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
          
                        
                    </ul>
                </div>
                </ul>
            </div>
            </div>
        </nav>
        <div id="profile-picture-container">
            <img id="fotoPerfil" src="" alt="Foto de Perfil">
        </div>
    <style>
        .perguntaSeguranca {
            color: black;
            background-color: white;
            font-size: larger;

        }

        body {
            background-color: white;
        }
        p{
            font-size: x-large;
        }
    </style>

    </header>

<div class="container">
        <h1 class="perguntaSeguranca" style="font-size: x-large;">Pergunta de Segurança</h1>
        <p><?php echo $perguntaSeguranca; ?></p>
        <form method="POST" action="confirma.php" class="formularioMaster" style="text-align: center" autocomplete="off">


            <?php
            if ($perguntaAleatoria == 2 || $perguntaAleatoria == 4) { //Aqui introduzo resposta caso seja sobre email ou cep
                echo '<div class="form-group">';
                echo '<label for="resposta" class="h2">Sua Resposta:</label>';
                echo '<input type="text" id="resposta" name="resposta" class="form-control" required>';
                echo '</div>';
                
                
            }
            if ($perguntaAleatoria == 1) { //Aqui introduzo resposta caso seja nome da mae 
                echo '<div class="form-group">';
                echo'
                <label for="resposta" class="h2">Sua Resposta:</label>';
                echo '<input type="text" id="resposta" name="resposta" required class="form-control" onblur="converterParaMaiusculo(this)">';
            } elseif ($perguntaAleatoria == 3) { //Se for 3 eu troco meu input para date
                echo '<label for="resposta">Sua Resposta:</label>';
                echo '<input type="date" id="resposta" name="resposta" required>';
            }
            ?>
            <input type="submit" value="Verificar Resposta" class="btn btn-primary">
        </form>
    </div>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
<script src="../geral.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</html>
