<?php

namespace App\Model;

class TagXProduto
{
    public static function getArray()
    {
        return array(
            'product_id'    => 0,
            'tag_id'        => 0,
            'tag_relevance' => 0
        );
    }

    public static function validar(array $tagxproduto)
    {
        if ($tagxproduto['product_id'] == 0){
            $_SESSION['mensagem'] = 'Não foi informado o ID do Produto';
            return false;
        }

        if ($tagxproduto['tag_id'] == 0){
            $_SESSION['mensagem'] = 'Não foi informado o ID da Tag';
            return false;
        }

        return true;
    }

    public static function gravar(array $tagxproduto)
    {
        $sql = 'INSERT INTO product_tag (product_id, tag_id, tag_relevance) ' . 
               'VALUES (:product_id, :tag_id, :tag_relevance)';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('product_id', $tagxproduto['product_id'], \PDO::PARAM_INT);
        $conn->bindValue('tag_id', $tagxproduto['tag_id'], \PDO::PARAM_INT);
        $conn->bindValue('tag_relevance', $tagxproduto['tag_relevance'], \PDO::PARAM_INT);
        return $conn->execute();
    }

    public static function carregar(int $proID = 0, int $tagID = 0)
    {
        $sql = 'SELECT * FROM product_tag ';

        if ($proID > 0 || $tagID > 0){
            $sql .= 'WHERE ';
        }

        if ($proID > 0){
            $sql .= 'product_id = :product_id ';

            if ($tagID > 0){
                $sql .= 'AND ';
            }
        }

        if ($tagID > 0){
            $sql .= 'tag_id = :tag_id';
        }

        $conn = Conexao::getConexao()->prepare($sql);

        if ($proID > 0){
            $conn->bindValue('product_id', $proID, \PDO::PARAM_INT);
        }

        if ($tagID > 0){
            $conn->bindValue('tag_id', $tagID, \PDO::PARAM_INT);
        }

        $conn->execute();
        $result = $conn->fetchAll();

        return $result;
    }

    public static function excluir(int $proID = 0, int $tagID = 0)
    {
        if ($proID == 0 && $tagID == 0){
            $_SESSION['mensagem'] = 'Código do produto e da Tag não informados.';
            return false;
        }

        $sql = 'DELETE FROM product_tag WHERE ';

        if ($proID > 0){
            $sql .= 'product_id = :product_id ';

            if ($tagID > 0){
                $sql .= 'AND ';
            }
        }

        if ($tagID > 0){
            $sql .= 'tag_id = :tag_id ';
        }
        
        $conn = Conexao::getConexao()->prepare($sql);

        if ($proID > 0){
            $conn->bindValue('product_id', $proID, \PDO::PARAM_INT);
        }

        if ($tagID > 0){
            $conn->bindValue('tag_id', $tagID, \PDO::PARAM_INT);
        }
        
        $conn->execute();
    }

    private static function totalSemAtribuicao(string $sql)
    {
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute();
        $result = $conn->fetchAll();
        return (int) $result[0]['total'];
    }

    public static function totalProdutosSemTags()
    {
        $sql = 'SELECT COUNT(p.id) as "total" FROM product p ' .
               'WHERE p.id NOT IN (SELECT product_id FROM product_tag)';
        return self::totalSemAtribuicao($sql);
    }

    public static function totalTagsSemProdutos()
    {
        $sql = 'SELECT COUNT(t.id) as "total" FROM tag t ' .
               'WHERE t.id NOT IN (SELECT tag_id FROM product_tag)';
        return self::totalSemAtribuicao($sql);
    }
}