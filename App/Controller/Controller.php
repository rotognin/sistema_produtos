<?php

namespace App\Controller;

use App\Model;

class Controller
{
    public static function loginAction(array $post, array $get)
    {
        // Obter os dados para o login
        if ($post['login'] == '' || $post['senha'] == ''){
            $_SESSION['mensagem'] = 'Login ou senha em branco.';
            self::homeAction();
            Exit;
        }

        $usuario = Model\Usuario::verificarLogin($post['login'], $post['senha']);

        if (!$usuario){
            $_SESSION['mensagem'] = 'Usuário ou senha inválidos.';
            self::homeAction();
            Exit;
        }

        // Login OK
        $_SESSION['usuID'] = $usuario['id'];
        $_SESSION['usuNome'] = $usuario['name'];
        self::viewAction('menu');
    }

    public static function menuAction()
    {
        self::viewAction('menu');
    }

    public static function produtosAction()
    {
        self::viewAction('produtos');
    }

    public static function tagsAction()
    {
        self::viewAction('tags');
    }

    public static function relTagsAction()
    {
        self::viewAction('relTags');
    }

    public static function relRelevanciaAction()
    {
        self::viewAction('relRelevancia');
    }

    public static function homeAction()
    {
        header('Location: ' . DIR['home']);
        Exit;
    }

    protected static function viewAction(string $view, string $addGet = '')
    {
        $location = 'sistema.php';
        $_SESSION['view']   = $view;
        $_SESSION['addGet'] = $addGet;

        header ('Location: ' . $location);
    }

    public static function logoutAction()
    {
        session_unset();
        self::homeAction();
    }
    
}