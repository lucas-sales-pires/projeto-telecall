<?php 
require 'conexao.php';
require 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    

<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = consultaUsuario($mysqli,$_SESSION['usuario'],2)["usuarios_id"];

    // Diretório onde as imagens serão armazenadas
    $diretorioDestino ="../fotosPerfil/";

    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        // Obtém informações sobre o arquivo
        $nomeArquivo = $userID . "_" . basename($_FILES["foto"]["name"]);
        $caminhoCompleto = $diretorioDestino . $nomeArquivo;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoCompleto)) {
            echo '<div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-success text-center">
                    <h2>Foto Atualizada!</h2>
                    <p>Foto de Perfil Atualizada com sucesso !.</p>
                    <a href="../php/alterarDados.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>';
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Erro no upload da imagem.";
    }
} else {
    echo "Requisição inválida.";
}

?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
</body>
</html>
