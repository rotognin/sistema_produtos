# Sistema de cadastros de produtos

Sistema de cadastro de produtos e vinculação de tags com atribuição de relevância de cada tag para o produto.

Esse projeto está hospedado em meu site. [Link para o projeto](https://rodrigotognin.com.br/produtos/index.php)

Usuário: `admin`
Senha: `123`

## Instalação local

Para utilizar localmente o sistema, é preciso ter um ambiente configurado da seguinte forma:

- PHP 7+
- MySQL 5.7+
- Servidor HTTP Apache / Nginx

## Passos para configurar o ambiente:

- Crie uma pasta em seu computador e baixe esse repositório nela (pode-se usar `git clone` ou baixar manualmente)
- No MySQL, crie um novo banco com o nome `products_db`
- Após isso abra o arquivo `scripts\tabelas.sql` e execute seu conteúdo no banco de dados para criar as tabelas
- O arquivo `scripts\dados.sql` pode ser executado, caso queira, para adicionar produtos, tags e atribuições de algumas tags aos produtos
- Abra o arquivo `App\Model\Conexao.php` e configure o acesso ao banco ajustando as variáveis `host`, `user` e `password`

Um usuário será criado para acesso ao sistema. O login é `admin` e a senha é `123`

## Descrição

O sistema permite cadastrar produtos e tags. Cada atribuição de tag ao produto possui um grau de relevância, sendo "Muito alta", "Alta", "Média", "Baixa" ou "Muito baixa". Essa relevância permite que, ao selecionar uma tag em específico, o sistema exiba em primeiro lugar os produtos com maior relevância para a tag atribuída.

Por exemplo: ao cadastrar "Arroz" e "Lasanha", ambos poderão ter a tag "Alimento" atribuída. Porém, ao listar produtos com a tag `Alimento`, o Arroz é mais relevante do que a Lasanha. Esse grau de relevância é configurado no cadastro/alteração dos produtos.

## Script de extração dos dados do relatório

O script SQL executado para exibir as tags, a quantidade de produtos por tag e os produtos com aquela tag em ordem de relevância segue abaixo:

```SQL
SELECT t.id, t.name, 
(SELECT COUNT(product_id) FROM product_tag WHERE tag_id = t.id ) as 'qtd_produtos',
COALESCE(GROUP_CONCAT(p.name ORDER BY pt.tag_relevance separator ', '), '') as 'produtos'
FROM tag t
LEFT JOIN product_tag pt ON t.id = pt.tag_id
LEFT JOIN product p ON p.id = pt.product_id
GROUP BY t.id
ORDER BY qtd_produtos DESC
```

Segue um exemplo de resultado dessa consulta:

ID | Tag | Produtos Vinculados | Produtos em ordem de relevância
:-------: | :---------: | :-------: | :-------:
2 | Casual   | 4 | Caderno, Boné Casual, Camisa, Tênnis
8 | Alimento | 3 | Macarrão, Arroz, Lasanha
1 | Esporte  | 2 | Tênnis, Boné Casual
3 | Elegante | 2 | Terno, Sofá em L (de canto)
4 | Formal   | 2 | Terno, Sofá em L (de canto)
7 | Praia    | 2 | Boné Casual, Camisa
5 | Fino     | 1 | Terno

Na tag "Alimento", tanto o "Macarrão" quanto o "Arroz" estão com a relevância "Muito alta", e a "Lasanha" está com relevância "Média", por isso ela aparece por último na lista.

## Informações adicionais do projeto

- Padrão MVC
- Bootstrap 4 (importando via CDN)