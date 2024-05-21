<?php
use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';
require 'conexao.php';

$sql = 'SELECT  usuario, usuarios.nome, perfis.nome_perfil AS perfil
FROM usuarios
JOIN perfis ON usuarios.perfil_id = perfis.perfil_id
UNION
SELECT usuario, usuarios_master.nome AS nome, perfis.nome_perfil
FROM usuarios_master
JOIN perfis ON usuarios_master_id = perfis.perfil_id;';

if ($_SESSION['usuarioMasterLogado'] == false) {
    header('Location: ../principal/index.html');
    exit;
}

$consulta = $mysqli->prepare($sql);
if ($consulta) {
    $consulta->execute();

    $resultado = $consulta->get_result(); // Obter o resultado da consulta

    $dompdf = new Dompdf();

    $html = '
    <html>
    <head>
        <style>
            h1 {
                text-align: center;
                font-size: 24px;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
    <h1>Relatório de Usuários Cadastrados</h1>
    <table>
        <tr>
            <th>Usuario</th>
            <th>Nome</th>
            <th>Perfil</th>
        </tr>';

    while ($linha = $resultado->fetch_assoc()) { 
        $html .= '
        <tr>
            <td>' . $linha["usuario"] . '</td>
            <td>' . $linha["nome"] . '</td>
            <td>' . $linha["perfil"] . '</td>
        </tr>';
    }

    $html .= '
    </table>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();
    $dompdf->stream('listaUsuarios.pdf');
}
?>
