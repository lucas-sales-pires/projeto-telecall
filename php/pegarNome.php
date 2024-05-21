<?php
require 'conexao.php';
require 'funcoes.php';

if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['usuarioMasterLogado']) && $_SESSION['usuarioMasterLogado'] == true) {
        $sexo = consultaSexoMaster($mysqli, $_SESSION['usuario'], $_SESSION['Perfil']);
        if ($sexo == 'M'|| $sexo == 'Outro') {
            echo "Olá! " . $_SESSION['usuario'];
        } else {
            echo "Olá! " . $_SESSION['usuario'];
        }
    } elseif (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] == true) {
        $sexo = consultaSexoComum($mysqli, $_SESSION['usuario'], $_SESSION['Perfil']);
        if ($sexo == 'M'|| $sexo == 'Outro') {
            echo "Olá! " . $_SESSION['usuario'];
        } else {
            echo "Olá! " . $_SESSION['usuario'];
        }
    }
}
?>
