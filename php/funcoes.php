<?php

function consultaUsuario($mysqli, $usuario, $perfil)
{
    $consulta = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ? AND perfil_id = ?");
    $consulta->bind_param("si", $usuario, $perfil);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        return $linha;
    } else {
        return null;
    }
}


function consultaMaster($mysqli, $usuario, $perfil)
{
    $consulta = $mysqli->prepare("SELECT * FROM usuarios_master WHERE usuario = ? AND perfil_id = ?");
    $consulta->bind_param("si", $usuario, $perfil);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        return $linha;
    } else {
        return null;
    }
}

function consultarSenha($mysqli, $usuario, $perfil)
{
    $consulta = $mysqli->prepare("SELECT senha FROM usuarios WHERE usuario = ? AND perfil_id = ?");
    $consulta->bind_param("si", $usuario, $perfil);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $senhaDoBanco = $linha['senha'];
        return $senhaDoBanco;
    }

    return null;
}

function obterPerguntaSeguranca($mysqli, $perguntaAleatoria, $usuario)
{
    $perguntaSeguranca = '';

    $consultaPergunta = $mysqli->prepare("SELECT pergunta FROM 2fa_perguntas WHERE pergunta_id = ?");
    $consultaPergunta->bind_param("i", $perguntaAleatoria);
    $consultaPergunta->execute();
    $resultadoPergunta = $consultaPergunta->get_result();

    if ($resultadoPergunta->num_rows > 0) {
        $linhaPergunta = $resultadoPergunta->fetch_assoc();
        $perguntaSeguranca = $linhaPergunta['pergunta'];

        $consultaResposta = $mysqli->prepare("SELECT mae, email, nascimento, cep FROM usuarios WHERE usuario = ?");
        $consultaResposta->bind_param("s", $usuario);
        $consultaResposta->execute();
        $resultadoResposta = $consultaResposta->get_result();

        if ($resultadoResposta->num_rows > 0) {
            $linhaResposta = $resultadoResposta->fetch_assoc();

            switch ($perguntaAleatoria) {
                case 1:
                    $respostaCorreta = $linhaResposta['mae'];
                    break;
                case 2:
                    $respostaCorreta = $linhaResposta['email'];
                    break;
                case 3:
                    $respostaCorreta = $linhaResposta['nascimento'];
                    break;
                default:
                    $respostaCorreta = $linhaResposta['cep'];
                    break;
            }

            $_SESSION['perguntaSeguranca'] = $perguntaSeguranca;
            $_SESSION['respostaCorreta'] = $respostaCorreta;
        }
    }

    return $perguntaSeguranca;
}


function alterarSenha($mysqli, $usuario, $novaSenha)
{
    $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

    $consulta = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE usuario = ?");
    $consulta->bind_param("ss", $senhaCriptografada, $usuario);

    if ($consulta->execute()) {
        return true; // A senha foi alterada com sucesso
    } else {
        return false; // Houve um erro ao alterar a senha
    }
}
function listarUsuarios($mysqli)
{
    $sql = 'SELECT usuario, nome, email, perfis.nome_perfil AS perfil
    FROM usuarios
    JOIN perfis ON usuarios.perfil_id = perfis.perfil_id

    UNION

    SELECT usuario, nome, email, perfis.nome_perfil
    FROM usuarios_master
    JOIN perfis ON usuarios_master.perfil_id = perfis.perfil_id';

    $resultado = $mysqli->query($sql);

    if (isset($resultado) && $resultado->num_rows > 0) {
        echo "<table class='table table-container'>";
        echo "<tr><th>Usuário</th><th>Nome</th><th>Email</th><th>Perfil</th></tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["usuario"] . "</td>";
            echo "<td>" . $linha["nome"] . "</td>";
            echo "<td>" . $linha["email"] . "</td>";
            echo "<td>" . $linha["perfil"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}

function listarUsuariosMaster($mysqli)
{
    $sql = '
    SELECT usuario, nome, email, perfis.nome_perfil
    FROM usuarios_master
    JOIN perfis ON usuarios_master.perfil_id = perfis.perfil_id';

    $resultado = $mysqli->query($sql);

    if (isset($resultado) && $resultado->num_rows > 0) {
        echo "<table class='table table-container'>";
        echo "<tr><th>Usuário</th><th>Nome</th><th>Email</th><th>Perfil</th></tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["usuario"] . "</td>";
            echo "<td>" . $linha["nome"] . "</td>";
            echo "<td>" . $linha["email"] . "</td>";
            echo "<td>" . $linha["nome_perfil"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
function verificarSenhaAtual($senhaDigitada, $senhaArmazenada)
{
    return password_verify($senhaDigitada, $senhaArmazenada);
}
function alterarDados($mysqli, $usuarioAtual)
{
    $sql = "SELECT usuario, nome, email, nascimento 
    FROM usuarios
    WHERE usuarios.usuario = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $usuarioAtual);
    $stmt->execute();
    $resultado = $stmt->get_result();


    if ($resultado !== false && $resultado->num_rows > 0) {
        echo "<form method='post' action='processarEdicao.php'>";
        echo "<table class='table table-container'>";
        echo "<tr><th>Usuário</th><th>Nome</th><th>Email</th><th>Nascimento</th><th>Senha Atual</th><th>Ação</th></tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='text' name='usuario' value='" . $linha["usuario"] . "' class='input-estilizado' minlength='6' maxlength='6'></td>";
            echo "<td><input type='text' name='nome' value='" . $linha["nome"] . "' class='input-estilizado' minlength='15' maxlength='80'></td>";
            echo "<td><input type='email' name='email' value='" . $linha["email"] . "' class='input-estilizado'></td>";
            echo "<td><input type='text' name='nascimento' value='" . $linha["nascimento"] . "' class='input-estilizado'  ></td> ";
            echo "<td><input type='password' name='senhaAtual' id='senhaAtual' minlength='8' maxlength='8' required placeholder='Insira sua senha atual' class='input100'></td>";
            echo "<td><button type='submit' class='btn btn-primary'>Salvar</button></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "Nenhum usuário encontrado.";
    }
}



function listarUsuariosComuns($mysqli)
{
    $sql = 'SELECT usuario, nome, email, perfis.nome_perfil AS perfil
    FROM usuarios
    JOIN perfis ON usuarios.perfil_id = perfis.perfil_id';

    $resultado = $mysqli->query($sql);

    if (isset($resultado) && $resultado->num_rows > 0) {
        echo "<table class='table table-container'>";
        echo "<tr><th>Usuário</th><th>Nome</th><th>Email</th><th>Perfil</th></tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["usuario"] . "</td>";
            echo "<td>" . $linha["nome"] . "</td>";
            echo "<td>" . $linha["email"] . "</td>";
            echo "<td>" . $linha["perfil"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}

function consultaSexoComum($mysqli, $usuario, $perfil)
{
    $consulta = $mysqli->prepare("SELECT sexo FROM usuarios WHERE usuario = ? AND perfil_id = ?");
    $consulta->bind_param("si", $usuario, $perfil);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        return $linha['sexo'];
    } else {
        return null;
    }
}

function consultaSexoMaster($mysqli, $usuario, $perfil)
{
    $consulta = $mysqli->prepare("SELECT sexo FROM usuarios_master WHERE usuario = ? AND perfil_id = ?");
    $consulta->bind_param("si", $usuario, $perfil);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        return $linha['sexo'];
    } else {
        return null;
    }
}
function registrarLog($mysqli, $cpf_usuario, $resultado, $descricao, $usuarios_id)
{
    date_default_timezone_set('America/Sao_Paulo');

    $data_login = date("Y-m-d");
    $horario_login = date("H:i:s");

    $stmt = $mysqli->prepare("INSERT INTO log_acesso (cpf_usuario, horario_login, data_login, resultado, descricao, usuarios_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $cpf_usuario, $horario_login, $data_login, $resultado, $descricao, $usuarios_id);
    $stmt->execute();
    $stmt->close();
}

function consultarLogs($mysqli, $nome = "", $data = "")
{
    $sql = "SELECT log_acesso.cpf_usuario, log_acesso.horario_login, log_acesso.data_login, log_acesso.resultado, log_acesso.descricao, log_acesso.usuarios_id, usuarios.nome
            FROM log_acesso
            JOIN usuarios ON log_acesso.cpf_usuario = usuarios.cpf";

    $parametros = array();

    if (!empty($nome)) {
        $sql .= " WHERE usuarios.nome LIKE ?";
        $parametros[] = "%{$nome}%";
    }

    if (!empty($data)) {
        $sql .= empty($nome) ? " WHERE" : " AND";
        $sql .= " log_acesso.data_login = ?";
        $parametros[] = $data;
    }

    $consulta = $mysqli->prepare($sql);

    if (!empty($parametros)) {
        $types = str_repeat('s', count($parametros));
        $consulta->bind_param($types, ...$parametros);
    }

    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        echo "<table class='table table-container'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>CPF</th>";
        echo "<th>Horário</th>";
        echo "<th>Data</th>";
        echo "<th>Resultado</th>";
        echo "<th>Descrição</th>";
        echo "<th>Usuário ID</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["nome"] . "</td>";
            echo "<td>" . $linha["cpf_usuario"] . "</td>";
            echo "<td>" . $linha["horario_login"] . "</td>";
            echo "<td>" . $linha["data_login"] . "</td>";
            echo "<td>" . $linha["resultado"] . "</td>";
            echo "<td>" . $linha["descricao"] . "</td>";
            echo "<td>" . $linha["usuarios_id"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
}

function zerarLogs($mysqli){
    $sql = 'DELETE FROM log_acesso';
    $consulta = $mysqli->query($sql);
    $consulta ?  'Log de acessos Zerados':'Houve um erro na solicitação !';
}

function erroSql(mysqli_sql_exception $e)
{
    //Dentro do $e eu armazeno o erro de sql
    if ($e->getCode() == 1062) {
        // Se o erro for 1062 é problema de chamado duplicada
        $detalhesDoErro = $e->getMessage();
        //Aqui eu pego a mensagem do erro    
        if (preg_match('/for key \'(.+)_UNIQUE\'/', $detalhesDoErro, $matches)) {
            // /for key é aonde eu começo \' ignora as aspas simples (.+) eu quero tudo que vem antes de _UNIQUE matches[0] seria a correspondência completa, mas eu só quero o nome da variável duplicada
            $tipoCampo = $matches[1];
            echo '<div class="container">
                <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert alert-danger text-center">
                        <h2>' . ucfirst($tipoCampo) . ' duplicado no Banco de Dados !</h2>
                        <a href="../cadastro/cadastro.html" class="btn btn-primary">Tentar Novamente</a>
                    </div>
                </div>
            </div>';
        } else {
            echo "Erro ao cadastrar o usuário: " . $e->getMessage();
        }
    } else {
        echo "Erro ao cadastrar o usuário: " . $e->getMessage();
    }
}
