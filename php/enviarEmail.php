<?php
require '../vendor/autoload.php';
require 'conexao.php';
require 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

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
<?php
$seg = '';

if (isset($_POST['login']) && $_POST['email']) {
    $_SESSION['usuario'] = $_POST['login'];
    $_SESSION['email'] = $_POST['email'];
    $seg = random_int(100000, 999999);
    $_SESSION['codigoGerado'] = $seg;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $email = $_SESSION['email'];
    $sql = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ? and email = ?");
    $sql->bind_param("ss", $usuario, $email);

    if ($sql->execute()) {
        $resultado = $sql->get_result();

        if ($resultado->num_rows > 0) {

            $destinatario = $_SESSION["email"];


            $transporter = new \PHPMailer\PHPMailer\PHPMailer();
            $transporter->isSMTP();
            $transporter->Host = 'smtp.office365.com';
            $transporter->SMTPAuth = true;
            $transporter->Username = 'diegofrancosales@outlook.com';
            $transporter->Password = '';
            $transporter->SMTPSecure = 'tls';
            $transporter->Port = 587;

            $transporter->setFrom('diegofrancosales@outlook.com', 'Telecall-Recuperação');
            $transporter->addAddress($destinatario);
            $transporter->Subject = 'Recuperacao de Senha';
            $transporter->Body = 'Conteúdo do e-mail de recuperação de senha. ' . $seg;

            if ($transporter->send()) {
                echo '<p id="verifique">Verifique seu email !</p>';

?>


                <body>
                    <div class="limiter">
                        <div class="container-login100" id="formularioRecuperacao">
                            <div class="container1">
                                <form class="login100-form validate-form" action="" method="post" id="codigoVerificacao" autocomplete="off">
                                    <div class="wrap-input100 validate-input">
                                        <label for="codigo">Digite o código de segurança :</label>
                                        <input type="text" id="codigo" name="codigo" required>
                                        <input type="submit" name="verificarCodigo">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <?php

                if (isset($_POST["verificarCodigo"])) {
                    $codigo = $_SESSION['codigoGerado'];
                    $codigoDigitado = $_POST['codigo'];
                    if ($codigoDigitado == $codigo) {
                        header("Location: alterarSenha.php");
                    } else {
                        echo 'Código incorreto';
                        echo '
                        <form method="post" action="">
                            <input type="submit" name="tentarNovamente" value="Tentar Novamente">
                        </form>';
                        echo '<script> 
                                let codigoVerificacao = document.getElementById("codigoVerificacao");
                                codigoVerificacao.style.display = "none"
                                
                                let verificar = document.getElementById("verifique");
                                verificar.style.display = "none";
                                </script>';
                    }
                }
            } else {
                echo 'Erro ao enviar o e-mail: ' . $transporter->ErrorInfo;
            }
        } else {
            echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger text-center">
                    <h2>Ops! Dados incorretos</h2>
                    <p>Lamentamos . <strong>Usuário</strong> ou <strong>Email</strong> incorreto.</p>
                    <a href="../php/recuperarSenha.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>';
        }
    } else {
        echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger text-center">
                    <h2>Erro ao executar Consulta</h2>
                    <p>Lamentamos .Estamos com problemas técnicos. Tente novamente mais tarde.</p>
                    <a href="../php/recuperarSenha.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>' . $sql->error;
    }
}
if (isset($_POST["tentarNovamente"])) {
    header("Location: ../php/recuperarSenha.php");
    exit();
}
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../geral.js"></script>
    <script src="../enviarEmail.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                </body>

</html>
