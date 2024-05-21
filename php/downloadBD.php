<?php
require 'conexao.php';

$arquivo_nome = 'backup.sql';

$arquivo = fopen($arquivo_nome, 'w');

$tabelas = $mysqli->query('SHOW TABLES');
while ($tabela = $tabelas->fetch_assoc()) {
    $nome_tabela = $tabela["Tables_in_$banco"];
    
    $estrutura_tabela = $mysqli->query("SHOW CREATE TABLE $nome_tabela");
    $linha_estrutura = $estrutura_tabela->fetch_assoc();
    $comando_criar_tabela = $linha_estrutura['Create Table'];
    
    fwrite($arquivo, "$comando_criar_tabela;\n");
    
    $dados = $mysqli->query("SELECT * FROM $nome_tabela");
    while ($linha = $dados->fetch_assoc()) {
        $valores = array_map(function ($valor) use ($mysqli) {
            return "'" . $mysqli->real_escape_string($valor) . "'";
        }, $linha);
        $comando_inserir = "INSERT INTO $nome_tabela VALUES (" . implode(', ', $valores) . ");\n";
        fwrite($arquivo, $comando_inserir);
    }
}

fclose($arquivo);

header('Content-Description: Transferência de Arquivo');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $arquivo_nome . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($arquivo_nome));

readfile($arquivo_nome);

unlink($arquivo_nome);

$mysqli->close();
?>
