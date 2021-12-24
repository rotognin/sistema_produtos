<?php

namespace App\Controller;

use App\Model;

class tagController extends Controller
{
    public static function cadTagAction(array $post, array $get)
    {   
        $_SESSION['id'] = (isset($post['id'])) ? $post['id'] : 0;
        parent::viewAction('cadTag');
    }

    public static function excTagAction(array $post, array $get)
    {
        $tagID = (isset($post['id'])) ? $post['id'] : 0;

        if (is_nan($tagID) || $tagID == 0){
            $_SESSION['mensagem'] = 'ID da Tag não informado.';
            parent::viewAction('tags');
            Exit;
        }

        $_SESSION['id'] = $tagID;
        parent::viewAction('excTag');
    }

    public static function excluirTagAction(array $post, array $get)
    {
        $tagID = (isset($post['id'])) ? $post['id'] : 0;

        if (is_nan($tagID) || $tagID == 0){
            $_SESSION['mensagem'] = 'ID da tag não informado.';
            parent::viewAction('tags');
            Exit;
        }

        Model\TagXProduto::excluir(0, $tagID);
        Model\Tag::excluir($tagID);

        parent::viewAction('tags');
    }

    private static function preencherArray(array $post)
    {
        $tag = Model\Tag::getArray();
        $tag['id']   = $post['id'];
        $tag['name'] = $post['name'];

        return $tag;
    }

    public static function atualizarTagAction(array $post, array $get)
    {
        $tag = self::preencherArray($post);

        if (!Model\Tag::validar($tag)){
            parent::viewAction('cadTag');
            return;
        }
        
        if (Model\Tag::atualizar($tag)){
            parent::viewAction('tags');
        } else {
            $_SESSION['mensagem'] = 'Registro da Tag não atualizado.';
            parent::viewAction('cadTag');
        }
    }

    public static function gravarTagAction(array $post, array $get)
    {
        $post['id'] = 0;
        $tag = self::preencherArray($post);

        if (!Model\Tag::validar($tag)) {
            parent::viewAction('cadTag');
            return;
        }

        if (Model\Tag::gravar($tag)) {
            parent::viewAction('tags');
        } else {
            $_SESSION['mensagem'] = 'Registro da Tag não gravado.';
            parent::viewAction('cadTag');
        }

    }
}