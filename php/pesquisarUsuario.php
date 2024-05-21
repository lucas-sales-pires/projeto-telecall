<?php require 'conexao.php';
require 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opções Master</title>
    <link rel="icon" type="image/x-icon" href="../favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

        <h2>Pesquisa de Usuários</h2>

        <form action="" method="GET" class="formularioMaster" autocomplete="off">
            <div class="form-group"></div>
            <label for="pesquisar">Pesquisar por nome:</label>
            <input type="text" id="pesquisar" name="pesquisar" value="<?php echo isset($_GET['pesquisar']) ? $_GET['pesquisar'] : ''; ?>">
            <input type="submit" value="Pesquisar" class="btn btn-primary">
        </form>

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
}else{
$pesquisaNome = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';

if (empty($pesquisaNome)) {
    $sql = "SELECT usuarios_id, usuario, nome, email, perfil_id
        FROM usuarios
        UNION
        SELECT usuarios_master_id, usuario, nome, email, perfil_id
        FROM usuarios_master";
} else {
    $sql = "SELECT usuarios_id, usuario, nome, email, perfil_id
        FROM usuarios
        WHERE usuario LIKE ?
        UNION
        SELECT usuarios_master_id, usuario, nome, email, perfil_id
        FROM usuarios_master
        WHERE usuario LIKE ?";
}

if ($consulta = $mysqli->prepare($sql)) {
    if (!empty($pesquisaNome)) {
        $pesquisaNome = "%" . $pesquisaNome . "%";
        $consulta->bind_param("ss", $pesquisaNome, $pesquisaNome);
    }

    $consulta->execute();
    $resultado = $consulta->get_result();
    $consulta->close();

    if ($resultado->num_rows > 0) {
        echo '<table class="table table-container">';
        echo '<tr><th>Usuário ID</th><th>Usuário</th><th>Nome</th><th>Email</th><th>Ação</th></tr>';

        while ($linha = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $linha["usuarios_id"] . '</td>';
            echo '<td>' . $linha["usuario"] . '</td>';
            echo '<td>' . $linha["nome"] . '</td>';
            echo '<td>' . $linha["email"] . '</td>';
            if ($linha["perfil_id"] != 1) {
                echo '<td><a href="?excluir=' . $linha["usuarios_id"] . '" class="btn btn-primary">Excluir</a></td>';
            } else {
                echo '<td>Opção de Excluir não disponível</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-sm-6 col-sm-offset-3">';
        echo '<div class="alert alert-danger text-center">';
        echo '<h2>Nenhum resultado encontrado</h2>';
        echo '<p>Nenhum usuário corresponde ao nome.</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Erro na consulta.';
}

if (isset($_GET['excluir'])) {
    $usuarioIDExcluir = $_GET['excluir'];
    $excluirLog = $mysqli->prepare("DELETE FROM log_acesso WHERE usuarios_id = ?");
    $excluirLog->bind_param("s",$usuarioIDExcluir);
    $excluirLog->execute();
    if ($consulta = $mysqli->prepare("DELETE FROM usuarios WHERE usuarios_id = ?")) {
        $consulta->bind_param("i", $usuarioIDExcluir);
        if ($consulta->execute()) {
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-sm-6 col-sm-offset-3">';
            echo '<div class="alert alert-danger text-center">';
            echo '<h2>Concluído!</h2>';
            echo '<p>Usuário com ID ' . $usuarioIDExcluir . ' excluído com sucesso!</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            
        } else {
            echo 'Falha ao excluir o usuário com ID ' . $usuarioIDExcluir . '.';
        }
        $consulta->close();
    } else {
        echo 'Erro ao excluir o usuário.';
    }
}
}
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
    <script src="../geral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>






</html>
