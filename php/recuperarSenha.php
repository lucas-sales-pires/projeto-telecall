<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Recuperação de Senha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="../node_modules/axios/dist/axios.min.js"></script>

</head>
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
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="container1">
                <form class="login100-form validate-form" action="enviarEmail.php" method="post" id="formularioRecuperarSenha" autocomplete="off">
                    <span class="login100-form-title">
                        Recuperação de Senha
                    </span>
                    <div class="wrap-input100 validate-input">
                        <label for="login">Login:</label>
                        <input id="login" type="text" class="input100" name="login">
                        <span class="focus-input100"></span>

                        <label for="email">Digite seu e-mail cadastrado:</label>
                        <input type="email" class="input100" id="email" name="email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <input type="submit" class="login100-form-btn" value="Enviar" />
                    </div>
                    <div class="text-center p-t-136">
                        <a class="txt2" href="../cadastro/cadastro.html">
                            Crie sua conta
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../geral.js"></script>
    <script src="../enviarEmail.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
