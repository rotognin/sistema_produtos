<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');

define('DS', DIRECTORY_SEPARATOR);
define('DIR', array('controller' => 'App' . DS . 'Controller' . DS,
                    'model'      => 'App' . DS . 'Model' . DS,
                    'view'       => 'App' . DS . 'View' . DS,
                    'home'       => 'index.php',
                    'log'        => 'log' . DS . 'log.txt'
                   )
        );
define('RELEVANCIA' , array(
    1 => 'Muito alta',
    2 => 'Alta',
    3 => 'Média',
    4 => 'Baixa',
    5 => 'Muito baixa'
));

function autoload($class)
{   
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    include_once($_SESSION['dir'] . $class . '.php');
}
spl_autoload_register('autoload');

require_once('funcoes.php');