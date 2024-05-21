<?php
require "conexao.php";
require "funcoes.php";
$usuarioID = consultaUsuario($mysqli, $_SESSION['usuario'], 2)["usuarios_id"];

$dir = '../fotosPerfil/';
$imagens = glob($dir . $usuarioID . '_*.{jpg,jpeg,png,gif}', GLOB_BRACE);

if (!empty($imagens)) {
    usort($imagens, function ($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    $ultimaImagem = $imagens[0];

    echo json_encode(['caminhoImagem' => $ultimaImagem]);
} else {
    echo json_encode(['caminhoImagem' => '../fotoPadrao/pngwing.com.png']);
}
?>
