<?php

namespace App\View;

use App\Model as Model;

$usuario = Model\Usuario::carregar($_SESSION['usuID']);
if (!$usuario || $usuario == ''){
    $_SESSION['mensagem'] .= ' - Realize o login no sistema.';
    header ('Location: index.php');
    Exit;
}

$total_produtos = Model\Produto::total();
$produtos_sem_tags = Model\TagXProduto::totalProdutosSemTags();

$total_tags = Model\Tag::total();
$tags_sem_produtos = Model\TagXProduto::totalTagsSemProdutos();

require_once 'html' . DS . 'menu.html.php';