INSERT INTO `product`
(`name`)
VALUES
("Tênnis"), ("Camisa"), ("Boné Casual"),
("Sofá em L (de canto)"), ("Caderno"),
("Arroz"), ("Lasanha"), ("Macarrão"), ("Terno");

INSERT INTO `tag`
(`name`)
VALUES
("Esporte"), ("Casual"), ("Elegante"),
("Formal"), ("Fino"), ("Praia"),
("Alimento");

INSERT INTO `product_tag`
(`product_id`, `tag_id`, `tag_relevance`)
VALUES
(1, 2, 2), (1, 6, 3), (2, 4, 1), (3, 2, 1), 
(6, 7, 1), (7, 7, 2), (8, 7, 1),
(4, 3, 4), (4, 2, 1), (5, 4, 1), (5, 2, 3);