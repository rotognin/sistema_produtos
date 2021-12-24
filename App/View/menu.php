<?php

namespace App\View;

use App\Model as Model;

$usuario = Model\Usuario::carregar($_SESSION['usuID']);
if (!$usuario || $usuario == ''){
    $_SESSION['mensagem'] .= ' - Realize o login no sistema.';
    header ('Location: index.php');
    Exit;
}

require_once 'html' . DS . 'menu.html.php';