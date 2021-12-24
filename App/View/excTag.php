<?php

/**
 * Confirmar a Exclusão de uma Tag
 */

namespace App\View;

use App\Model as Model;

$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;

$tag = Model\Tag::carregar($id);

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'excTag.html.php';