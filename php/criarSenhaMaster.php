<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <label for="senha">Senha Master</label>
    <input type="password" id="senha" class="form-control" maxlength="8" minlength="8"pattern="^[A-Za-z]+$" placeholder="Apenas letras" name="senha" required>
    <input type="submit" value="enviar">
</form>
</body>
</html>
<?php 
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){

$senha = $_POST['senha'];
$senhaCriptografada = password_hash($senha,PASSWORD_DEFAULT);
echo $senhaCriptografada;
}
?>
