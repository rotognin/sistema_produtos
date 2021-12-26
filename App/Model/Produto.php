<?php

namespace App\Model;

class Produto
{
    public static function getArray()
    {
        return array(
            'id'        => 0,
            'name'      => ''
        );
    }

    public static function validar(array $produto)
    {
        if ($produto['name'] == ''){
            $_SESSION['mensagem'] = 'O nome do produto deve ser preenchido.';
            return false;
        }

        $produto['name'] = verificarString($produto['name']);

        return true;
    }

    public static function gravar(array $produto)
    {
        $sql = 'INSERT INTO product (name) VALUES (:name)';
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('name', $produto['name']);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    public static function atualizar(array $produto)
    {
        $sql = 'UPDATE product SET name = :name WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('name', $produto['name']);
        $conn->bindValue('id', $produto['id'], \PDO::PARAM_INT);
        return $conn->execute();
    }

    public static function excluir(int $proID)
    {
        if (is_nan($proID) || $proID == 0){
            $_SESSION['mensagem'] = 'ID do produto não informado.';
            return false;
        }

        $sql = 'DELETE FROM product WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('id', $proID, \PDO::PARAM_INT);
        $conn->execute();
    }

    public static function carregar(int $proID)
    {
        $sql = 'SELECT * FROM product WHERE id = :id';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('id', $proID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();

        return $result[0];
    }

    public static function total()
    {
        $sql = 'SELECT COUNT(name) as total FROM product';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute();
        $result = $conn->fetchAll();
        return (int) $result[0]['total'];
    }

    public static function listar(int $pagina = 0, int $quantidade = 0)
    {
        $sql = "SELECT p.id, p.name, COALESCE(GROUP_CONCAT(t.name separator ', '), '') as 'tags' " . 
               "FROM product p " .
               "LEFT JOIN product_tag pt ON pt.product_id = p.id " . 
               "LEFT JOIN tag t ON pt.tag_id = t.id " . 
               "GROUP BY p.name " . 
               "ORDER BY p.id ";

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute();
        $produtos = $conn->fetchAll();
        return $produtos;
    }
}