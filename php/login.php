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
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../estilosPhp.css">

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
                        <li><a href="../principal/index.html">Home</a></li>
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
    $perfil = $_POST['Perfil']; //Obtenho o tipo de perfil
    $usuario = $_POST['usuario']; //Obtenho o nome do usuario
    $perguntaAleatoria = rand(1, 4); //Gero um número aleatório para buscar a pergunta no banco


    if ($perfil == 1) { //Se o perfil for Master
        $_SESSION['usuario'] = $usuario;
        $_SESSION['perfil'] = $perfil;
        $_SESSION['senha'] = $_POST['Senha'];
        header('Location: ../php/loginMaster.php');
    }

    if ($perfil == 2) { //Se o perfil for comum
        $_SESSION['usuario'] = $usuario;
        $_SESSION['perfil'] = $_POST['Perfil'];
        $_SESSION['senha'] = password_hash($_POST['Senha'], PASSWORD_DEFAULT);
        if (consultaUsuario($mysqli, $usuario, $perfil)) {
            $_SESSION['perguntaAleatoria'] = $perguntaAleatoria;
            $perguntaSeguranca = obterPerguntaSeguranca($mysqli, $perguntaAleatoria, $usuario);
            $_SESSION['perguntaSegurança'] = $perguntaSeguranca;
            $senhaDigitada = $_POST['Senha'];
            $senhaDoBanco = consultarSenha($mysqli, $usuario, $perfil);
            if ($senhaDoBanco !== null) {

                if (password_verify($senhaDigitada, $senhaDoBanco)) {
                    header("Location: ../php/perguntaSeguranca.php");
                } else {
                    echo '<div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="alert alert-danger text-center">
                                <h2>Senha Incorreta</h2>
                                <p>A Senha digitada está incorreta</p>
                                <a href="../login/login.html" class="btn btn-primary">Tentar Novamente</a>
                            </div>
                        </div>
                    </div>
                </div>';
                    $resultado_login = 'Falha';
                    $descricao = 'Não Logado Senha incorreta: ';
                    $usuarios_id = consultaUsuario($mysqli, $usuario, $perfil)['usuarios_id'];
                    $cpf_usuario = consultaUsuario($mysqli, $usuario, $perfil)['cpf'];
                    registrarLog($mysqli, $cpf_usuario, $resultado_login, $descricao, $usuarios_id);
                }
            }
        } else {
            echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger text-center">
                    <h2>Usuário Não Encontrado !</h2>
                    <p>Usuário Não Cadastrado No Nosso Sistema !</p>
                    <a href="../login/login.html" class="btn btn-primary">Tentar Novamente</a>
                </div>
            </div>
        </div>
    </div>';
        }
    }


    ?>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
<script src="../geral.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</html>
