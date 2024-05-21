<?php require 'conexao.php';
require 'funcoes.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meus Dados</title>
    <link rel="icon" type="image/x-icon" href="../favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <div class="pesquisa">
    <div class="pesquisaComum">
        <h2>Editar Meus Dados</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="formularioMaster" autocomplete="off">
            <input type="submit" name="listarUsuario" value="Listar Meus Dados" class="btn btn-primary">
        </form>

        <form action="./atualizarFoto.php" method="POST" class="formularioMaster" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Foto</button>
        </form>
    </div>
    </div>

    </div>


    <?php
    if (!isset($_SESSION['usuario'])) {
        echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-danger text-center">
                    <h2>Ops! Você deslogou.</h2>
                    <p>Lamentamos que você tenha saído. Você pode fazer o login novamente clicando no botão abaixo.</p>
                    <a href="../login/login.html" class="btn btn-primary">Fazer Login</a>
                </div>
            </div>
        </div>
    </div>';
    }
    if (isset($_POST['listarUsuario'])) {
        alterarDados($mysqli, $_SESSION['usuario']);
    }


    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
    <script src="../geral.js"></script>
    <script src="../cadastro/config_tela3/validacoesCadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
