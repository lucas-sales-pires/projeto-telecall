<?php
session_start();
$response = [];

if (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
    $response['usuarioLogado'] = true;
} else {
    $response['usuarioLogado'] = false;
}

if (isset($_SESSION['usuarioMasterLogado']) && $_SESSION['usuarioMasterLogado'] === true) {
    $response['usuarioMasterLogado'] = true;
} else {
    $response['usuarioMasterLogado'] = false;
}

echo json_encode($response);

?>
