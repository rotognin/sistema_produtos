<?php

namespace App\Model;

class Usuario
{
    public static function getArray()
    {
        return array(
            'id'       => 0,
            'name'     => '',
            'login'    => '',
            'password' => ''
        );
    }

    public static function carregar(int $id)
    {
        if (is_nan($id) || $id == 0){
            $_SESSION['mensagem'] = 'Carregamento incorreto: [Usuario - Carregar - ' . $id . ']';
            return false;
        }

        $sql = 'SELECT * FROM users WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('id', $id, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();

        if (empty($result)){
            return false;
        }

        return $result[0];
    }

    public static function verificarLogin(string $login, string $password){
        $sql = 'SELECT * FROM users WHERE login = :login';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('login', $login);
        $conn->execute();
        $result = $conn->fetchAll();

        if (empty($result)){
            return false;
        }

        $passwordSha1 = sha1($password);

        if ($passwordSha1 != $result[0]['password']){
            return false;
        }

        return $result[0];
    }
}