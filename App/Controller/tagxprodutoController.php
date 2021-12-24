<?php

namespace App\Controller;

use App\Model;

class tagxprodutoController extends Controller
{
    public static function cadTagXProdutoAction(array $post, array $get)
    {   
        $_SESSION['id_produto'] = (isset($post['id'])) ? $post['id'] : 0;
        parent::viewAction('cadTagXProduto');
    }

    public static function excTagXProdutoAction(array $post, array $get)
    {
        if (!isset($post['product_id']) || $post['product_id'] == 0){
            $_SESSION['mensagem'] = 'ID do produto não informado.';
            return false;
        }

        if (!isset($post['tag_id']) || $post['tag_id'] == 0){
            $_SESSION['mensagem'] = 'ID da Tag não informado.';
            return false;
        }

        Model\TagXProduto::excluir($post['produto_id'], $post['tag_id']);
    }

    private static function preencherArray(array $post)
    {
        $tagxproduto = Model\TagXProduto::getArray();
        $tagxproduto['product_id'] = $post['product_id'];
        $tagxproduto['tag_id'] = $post['tag_id'];
        $tagxproduto['tag_relevance'] = $post['tag_relevance'];

        return $tagxproduto;
    }

    public static function gravarTagXProdutoAction(array $post, array $get)
    {
        $produto_id = $post['id'];

        if (is_nan($produto_id) || $produto_id == 0){
            $_SESSION['mensagem'] = 'Produto com código zerado.';
            parent::viewAction('cadTagXProduto');
            Exit;
        }

        Model\TagXProduto::excluir($produto_id);

        if (!isset($post['tag'])){
            parent::viewAction('produtos');
            Exit;
        }

        $tags = $post['tag'];
        $tag_relevance = $post['tag_relevance'];

        foreach($tags as $tag){
            if (!Model\TagXProduto::gravar(array('product_id' => $produto_id, 'tag_id' => $tag, 'tag_relevance' => $tag_relevance[$tag]))){
                $_SESSION['mensagem'] = 'Tags não atribuídas ao Produto';
            }
        }
    }
}