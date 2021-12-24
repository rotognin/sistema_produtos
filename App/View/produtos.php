<?php

/**
 * Listar todos os Produtos cadastrados
 */

namespace App\View;

use App\Model as Model;

$total = Model\Produto::total();

$produtos = Model\Produto::listar();

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS .'produtos.html.php';