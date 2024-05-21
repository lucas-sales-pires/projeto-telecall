<?php
// Tudo para acessar o banco de dados necessário
$Usuario = 'root';  // Seus dados de usuário para entrar no banco de dados
$Senha = '';        // Sua senha do banco de dados
$host = 'localhost'; // Seu servidor
$banco = 'bancotelecall';    // Nome do seu banco de dados
$mysqli = new mysqli($host, $Usuario, $Senha, $banco); // Criei um objeto mysqli para iniciar a sessão
session_start();

if ($mysqli->error) { // Caso aconteça algum erro para conectar, deve aparecer isso
    die("Falha ao conectar no servidor" . $mysqli->error);
}
