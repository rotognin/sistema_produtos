<?php

session_start();

// Ao cair nessa página, se o usuário estiver logado, irá ser deslogado do sistema.
$_SESSION['usuID'] = 0;
$_SESSION['usuNome'] = '';
$_SESSION['dir'] = __DIR__ . DIRECTORY_SEPARATOR;

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once ('lib' . DIRECTORY_SEPARATOR . 'definicoes.php');
?>

<!DOCTYPE html>
<html>
<?php include 'html' . DIRECTORY_SEPARATOR . 'head.php'; ?>
<body> 
    <div class="container">
        <br>
        <div class="card text-center">
            <br>
            <h2>Sistema de Produtos</h2>
            <br>
            <form method="post" action="principal.php?action=login">
                <div class="form-group">
                    <label for="login">Login: </label>
                    <input type="text" id="login" name="login" autofocus>
                </div>
                <div class="form-group">
                    <label for="senha">Senha: </label>
                    <input type="password" id="senha" name="senha">
                </div>
                <input type="submit" value="Entrar" class="btn btn-primary">
            </form>
            <br>
            <?php 
                $regra = 'danger';
                include_once 'lib/mensagem.php';
            ?>
            <br>
        </div>
    </div>
    <?php include 'html' . DIRECTORY_SEPARATOR . 'scriptsjs.php'; ?>
</body>
</html>