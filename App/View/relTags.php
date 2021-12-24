<?php

/**
 * Relatório de Tags e produtos vinculados
 */

namespace App\View;

use App\Model as Model;

$tags = Model\Tag::relatorio();

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'relTags.html.php';