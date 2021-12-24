<?php

/**
 * Cadastro de Tags
 */

namespace App\View;

use App\Model as Model;

$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;

$tag = Model\Tag::getArray();
$novo = true;

if ($id > 0){
    $tag = Model\Tag::carregar($id);

    if (!$tag){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados da Tag.';
    } else {
        $novo = false;
    }
}

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'cadTag.html.php';