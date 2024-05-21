<?php
require 'conexao.php';
require 'funcoes.php';
$usuario =$_SESSION['usuario'];
$perfil = $_SESSION['perfil'];
$cpf_usuario = consultaUsuario($mysqli,$usuario,$perfil)['cpf'];


$usuarios_id = consultaUsuario($mysqli, $usuario,$perfil)['usuarios_id'];
registrarLog($mysqli,$cpf_usuario,"Deslogou"," O Usuário ".$usuario." Deslogou ",$usuarios_id);

$_SESSION['usuarioLogado'] = false;
session_destroy();
header("Location: " . $_SERVER['HTTP_REFERER']);

exit;
?>
