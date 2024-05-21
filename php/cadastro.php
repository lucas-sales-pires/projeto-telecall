<?php
require 'conexao.php';
require 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['usuario'];

    try {
        // Consulta para verificar se o usuário já existe no banco
        $verificaUsuario = $mysqli->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
        $verificaUsuario->bind_param("s", $login);
        $verificaUsuario->execute();
        $resultadoVerificacao = $verificaUsuario->get_result();

        if ($resultadoVerificacao->num_rows > 0) {
            echo '<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="alert alert-danger text-center">
                <h2>Usuário já Cadastrado !</h2>
                <p>Usuario já Cadastrado no Banco de Dados.</p>
                <a href="../login/login.html" class="btn btn-primary">Fazer Login</a>
            </div>
        </div>
    </div>
</div>';
        } else {
            // O usuário não existe no banco, então podemos cadastrá-lo
            $nome = $_POST['Nome'];
            $email = $_POST['Email'];
            $nascimento = $_POST['Nascimento'];
            $sexo = $_POST['Sexo'];
            $mae = $_POST['Mae'];
            if (empty($mae)) {
                $mae = "NÃO DECLARADO";
            }
            $cpf = str_replace(['.', '-'], '', $_POST['Cpf']);
            $celular = $_POST['Celular'];
            $telefone = $_POST['Telefone'];
            $cep = $_POST['Cep'];
            $endereco = $_POST['Endereco'];
            $bairro = $_POST['Bairro'];
            $estado = $_POST['Estado'];
            $numero = $_POST['Numero'];
            $senha = $_POST['Senha'];
            $perfil = 2;

            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $consulta = $mysqli->prepare("INSERT INTO usuarios (nome, email, nascimento, sexo, mae, cpf, celular, telefone, cep, endereco, bairro, estado, numero, perfil_id, usuario, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?);");

            $consulta->bind_param("sssssssssssssiss", $nome, $email, $nascimento, $sexo, $mae, $cpf, $celular, $telefone, $cep, $endereco, $bairro, $estado, $numero, $perfil, $login, $hash);


            if ($consulta->execute()) {
                echo '<div class="container mt-4">
                    <div class="col-sm-6 offset-sm-3 text-center" style="width: 100%">
                        <div class="alert alert-success">
                            <h2><strong>Cadastro Bem Sucedido!</strong></h2>
                        </div>
                    </div>
                </div>';
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
                echo 'Erro ao cadastrar o usuário no banco de dados.';
            }
        }
    } catch (mysqli_sql_exception $e) {
         //Nesta parte estou procurando o erro especifico para o sql e colocando ele na variável $e
        erroSql($e);
        
    }
} else {
    echo 'Método de solicitação inválido.';
}
?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
    <script src="../geral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
