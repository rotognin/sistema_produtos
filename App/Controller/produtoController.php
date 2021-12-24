<?php

namespace App\Controller;

use App\Model;

class produtoController extends Controller
{
    public static function cadProdutoAction(array $post, array $get)
    {
        $_SESSION['id'] = (isset($post['id'])) ? $post['id'] : 0;
        parent::viewAction('cadProduto');
    }

    public static function excProdutoAction(array $post, array $get)
    {
        $proID = (isset($post['id'])) ? $post['id'] : 0;

        if (is_nan($proID) || $proID == 0){
            $_SESSION['mensagem'] = 'ID do Produto não informado.';
            parent::viewAction('produtos');
            Exit;
        }

        $_SESSION['id'] = $proID;
        parent::viewAction('excProduto');
    }

    public static function excluirProdutoAction(array $post, array $get)
    {
        $proID = (isset($post['id'])) ? $post['id'] : 0;

        if (is_nan($proID) || $proID == 0){
            $_SESSION['mensagem'] = 'ID do produto não informado.';
            parent::viewAction('produtos');
            Exit;
        }

        Model\TagXProduto::excluir($proID);
        Model\Produto::excluir($proID);

        parent::viewAction('produtos');
    }

    private static function preencherArray(array $post)
    {
        $produto = Model\Produto::getArray();
        $produto['id']   = $post['id'];
        $produto['name'] = $post['name'];

        return $produto;
    }

    public static function atualizarProdutoAction(array $post, array $get)
    {
        $produto = self::preencherArray($post);

        if (!Model\Produto::validar($produto)){
            parent::viewAction('cadProduto');
            return;
        }
        
        if (Model\Produto::atualizar($produto)){
            tagxprodutoController::gravarTagXProdutoAction($post, $get);
            parent::viewAction('produtos');
        } else {
            $_SESSION['mensagem'] = 'Registro do produto não atualizado.';
            parent::viewAction('cadProduto');
        }
    }

    public static function gravarProdutoAction(array $post, array $get)
    {
        $post['id'] = 0;
        $produto = self::preencherArray($post);

        if (!Model\Produto::validar($produto)) {
            parent::viewAction('cadProduto');
            return;
        }

        $post['id'] = Model\Produto::gravar($produto);

        if (is_numeric($post['id']) && $post['id'] > 0) {
            tagxprodutoController::gravarTagXProdutoAction($post, $get);
            parent::viewAction('produtos');
        } else {
            $_SESSION['mensagem'] = 'Registro do produto não gravado.';
            parent::viewAction('cadProduto');
        }

    }
}