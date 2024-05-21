<?php

require "conexao.php";
require "funcoes.php";
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
    </header>

    <?php
    try{
    $respostaUsuario = $_POST['resposta'];
    $respostaCorreta = $_SESSION['respostaCorreta'];

    $perfil = $_SESSION['perfil'];
    $usuario = $_SESSION['usuario'];
    $senhaDigitada = $_SESSION['senha'];
    $senhaDoBanco = consultarSenha($mysqli, $usuario, $perfil);
    if ($senhaDoBanco !== null) {

  
            if ($respostaUsuario == $respostaCorreta) {
                $resultado_login = 'Sucesso';
                $descricao = 'Logado com Sucesso Respondendo corretamente: '.$_SESSION['perguntaSegurança'];
                $usuarios_id = consultaUsuario($mysqli, $usuario,$perfil)['usuarios_id'];
                $cpf_usuario = consultaUsuario($mysqli,$usuario,$perfil)['cpf'];
                registrarLog($mysqli, $cpf_usuario, $resultado_login, $descricao, $usuarios_id);
                echo '<div class="container mt-4">
                
                    <div class="col-sm-6 offset-sm-3 text-center" style="width: 100%">
                        <div class="alert alert-success">
                            <h2><strong>Login Bem Sucedido!</strong></h2>
                        </div>
                    </div>
                
            </div>';
                $_SESSION['usuarioLogado'] = true;
                $_SESSION['Perfil'] = $perfil;
                $_SESSION['usuario'] = $usuario;
                echo '<div class="sk-fading-circle">
                <div class="sk-circle"></div>
                <div class="sk-circle sk-circle2"></div>
                <div class="sk-circle sk-circle3"></div>
                <div class="sk-circle sk-circle4"></div>
                <div class="sk-circle sk-circle5"></div>
                <div class="sk-circle sk-circle6"></div>
                <div class="sk-circle sk-circle7"></div>
                <div class="sk-circle sk-circle8"></div>
                <div class="sk-circle sk-circle9"></div>
                <div class="sk-circle sk-circle10"></div>
                <div class="sk-circle sk-circle11"></div>
                <div class="sk-circle sk-circle12"></div>
            </div>';
                echo '<script>
            setTimeout(function() {
                window.location.href = "../principal/index.html";
            }, 3000); 
        </script>';
                exit;
            } else {
                $resultado_login = 'Falha';
                $descricao = 'Não Logado Respondeu incorretamente: '.$_SESSION['perguntaSegurança'];
                $usuarios_id = consultaUsuario($mysqli, $usuario,$perfil)['usuarios_id'];
                $cpf_usuario = consultaUsuario($mysqli,$usuario,$perfil)['cpf'];
                registrarLog($mysqli, $cpf_usuario, $resultado_login, $descricao, $usuarios_id);
                $mensagemErro = 'Resposta incorreta. Tente Novamente <a href="../php/perguntaSeguranca.php" class="btn btn-primary">Tentar Novamente</a>';
                
            }
        
    } else {
        $mensagemErro = 'Usuário não encontrado.';
    }

    if (isset($mensagemErro)) {
        echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger text-center">
                    <h2>' . $mensagemErro . '</h2>
                </div>
            </div>
        </div>
    </div>';
    }}

    catch (Exception $e) {
        echo "Ocorreu uma exceção: " . $e->getMessage();
    }
    ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
    <script src="../geral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
