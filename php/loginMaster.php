<?php
require 'conexao.php';
require 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Master</title>
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
    $perfil = $_POST['Perfil'];
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $consulta = consultaMaster($mysqli, $usuario, $perfil);


    if ($_SERVER["REQUEST_METHOD"] == "POST" && $consulta != null) {
        $senhaDigitada = $_POST['Senha'];

        $perfil = 1;

        $resultadoSenha = $consulta['senha'];

        if (password_verify($senhaDigitada, $resultadoSenha)) {
            $_SESSION['usuarioMasterLogado'] = true;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['Perfil'] = $perfil;
            header("Location: ../principal/index.html");
            exit;
        } else {
            $mensagemDeErro = "Senha incorreta!";
        }
    } else {
        $mensagemDeErro = "Usuário não Cadastrado!";
    }


    if (isset($mensagemDeErro)) {
        echo '<div class="container">
        <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="alert alert-danger text-center">
                <h2>' . $mensagemDeErro . '</h2>
                <a href="../login/login.html" class="btn btn-primary">Tentar Novamente</a>
            </div>
        </div>
    </div>';
    }
    ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
    <script src="../geral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
