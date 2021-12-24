<!DOCTYPE html>
<html>
<?php include 'html' . DIRECTORY_SEPARATOR . 'head.php'; ?>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link text-white" href="principal.php?action=menu">Início</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=tags">Lista de Tags</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=produtos">Lista de Produtos</a>
                </div>
            </div>
        </nav>
        <br>
        <h3><?php echo verdade($novo, 'Novo ', 'Editar '); ?>Produto</h3>
    </div>
    <div class="container-fluid">
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post"
                  action="principal.php?control=produto&action=<?php echo verdade($novo, 'gravarProduto', 'atualizarProduto'); ?>">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input class="form-control" type="text" id="id" name="id" value="<?php echo $produto['id']; ?>" readonly>
                </div>
                <!-- Nome do Produto-->
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" class="form-control" 
                        name="name" value="<?php echo $produto['name']; ?>" autofocus required 
                        maxlength="50">
                </div>
                <br>
                <strong>Tags:</strong>

                <table class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>&nbsp;</th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Relevância</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($tags as $tag)
                        {
                            $checked = '';
                            $relevancia = 3;

                            if (array_key_exists($tag['id'], $arr_tags_produto)){
                                $checked = ' checked';
                                $relevancia = $arr_tags_produto[$tag['id']];
                            }

                            echo '<tr>';
                                echo '<td><input type="checkbox" id="tag' . $tag['id'] . '" name="tag[]" ' .
                                    'value="' . $tag['id'] . '" ' . $checked . '></td>';
                                echo '<td>' . $tag['id'] . '</td>';
                                echo '<td>' . $tag['name'] . '</td>';
                                echo '<td>';
                                    echo '<select id="tag_relevance' . $tag['id'] . '" name="tag_relevance[' . $tag['id'] . ']">';

                                    foreach(RELEVANCIA as $grau => $descricao)
                                    {
                                        echo '<option value="' . $grau . '" ';
                                        if ($grau == $relevancia) {
                                            echo 'selected';
                                        }
                                        echo '>' . $descricao . '&nbsp;&nbsp;&nbsp;</option>';
                                    }

                                    echo '</select>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>

                        <br>
                    </tbody>
                </table>

                <button type="submit" value="Gravar" class="btn btn-primary">Gravar</button>
            </form>
        <br>
    </div>
</body>
</html>