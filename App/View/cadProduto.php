<?php

/**
 * Cadastro de Produtos
 */

namespace App\View;

use App\Model as Model;

$id_produto = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;

$produto = Model\Produto::getArray();
$novo = true;

if ($id_produto > 0){
    $produto = Model\Produto::carregar($id_produto);

    if (!$produto){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados do Produto.';
    } else {
        $novo = false;
    }
}

$tags_produto = ($id_produto > 0) ? Model\TagXProduto::carregar($id_produto) : array();
$tags = Model\Tag::listar();

$arr_tags_produto = array();

if (!empty($tags_produto)){
    foreach($tags_produto as $tag_produto)
    {
        $arr_tags_produto[$tag_produto['tag_id']] = $tag_produto['tag_relevance'];
    }
}

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once 'html' . DS . 'cadProduto.html.php';