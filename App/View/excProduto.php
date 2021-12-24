<?php

/**
 * Confirmar a Exclusão de um Produto
 */

namespace App\View;

use App\Model as Model;

$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;

$produto = Model\Produto::carregar($id);

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'excProduto.html.php';