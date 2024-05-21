<?php


include 'conexao.php'; //incluo minha conexão para acessar o banco

if (isset($_SESSION['usuario'])) {  //se existir usuario na sessão
    $Usuario = $_SESSION['usuario'];  // eu salvo meu usuario nela
    $mensagem = "Seja Bem Vindo(a)! " . $Usuario . "!"; //e introduzo a mensagem de boas vindas
} else {
    $mensagem = ''; //se não a mensagem fica vazia
}




?>
