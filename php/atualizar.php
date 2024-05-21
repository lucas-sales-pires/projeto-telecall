<?php
require 'conexao.php';
require 'funcoes.php';

$usuario = $_SESSION['usuario']; // Obtém o usuário logado
$novaSenha = $_POST['novaSenha']; // Obtém a nova senha

if ($usuario && $novaSenha) {
    if (alterarSenha($mysqli, $usuario, $novaSenha)) {
        header('Location: ../principal/index.html'); 
    } else {
        echo 'Ocorreu um problema técnico ao atualizar a senha no banco de dados.';
    }
} else {
    echo 'Ocorreu um problema técnico, ligue para (+55) 21 4002-8922';
}
?>
