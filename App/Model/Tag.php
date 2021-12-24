<?php

namespace App\Model;

class Tag
{
    public static function getArray()
    {
        return array(
            'id'   => 0,
            'name' => ''
        );
    }

    public static function validar(array $tag)
    {
        if ($tag['name'] == ''){
            $_SESSION['mensagem'] = 'O nome da tag deve ser preenchido.';
            return false;
        }

        $tag['name'] = verificarString($tag['name']);

        return true;
    }

    public static function gravar(array $tag)
    {
        $sql = 'INSERT INTO tag (name) VALUES (:name)';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('name', $tag['name']);
        return $conn->execute();
    }

    public static function atualizar(array $tag)
    {
        $sql = 'UPDATE tag SET name = :name WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('name', $tag['name']);
        $conn->bindValue('id', $tag['id'], \PDO::PARAM_INT);
        return $conn->execute();
    }

    public static function excluir(int $tagID)
    {
        if (is_nan($tagID) || $tagID == 0){
            $_SESSION['mensagem'] = 'ID da tag não informado.';
            return false;
        }

        $sql = 'DELETE FROM tag WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('id', $tagID, \PDO::PARAM_INT);
        $conn->execute();
    }

    public static function carregar(int $id)
    {
        $sql = 'SELECT * FROM tag WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('id', $id, \PDO::PARAM_INT);
        $conn->execute();
        return $conn->fetchAll()[0];
    }

    public static function listar()
    {
        $sql = 'SELECT * FROM tag ORDER BY name ASC';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute();
        return $conn->fetchAll();
    }

    public static function relatorio()
    {
        $sql = 'SELECT t.id, t.name, ' .
               '(SELECT COUNT(product_id) FROM product_tag WHERE tag_id = t.id ) as "qtd_produtos", ' .
               'COALESCE(GROUP_CONCAT(p.name ORDER BY pt.tag_relevance separator ", "), "") as "produtos" ' .
               'FROM tag t ' .
               'LEFT JOIN product_tag pt ON t.id = pt.tag_id ' .
               'LEFT JOIN product p ON p.id = pt.product_id ' .
               'GROUP BY t.id ' .
               'ORDER BY qtd_produtos DESC';

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute();
        return $conn->fetchAll();
    }
}