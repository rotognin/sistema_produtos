<?php

/**
 * Listar todas as tags cadastradas
 */

namespace App\View;

use App\Model as Model;

$tags = Model\Tag::listar();

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'tags.html.php';