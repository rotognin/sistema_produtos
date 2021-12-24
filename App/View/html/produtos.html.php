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
                    <a class="nav-link text-white" href="principal.php?action=tags">Tags</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?control=produto&action=cadProduto">Novo Produto</a>
                </div>
            </div>
        </nav>
        <br>
    </div>
    <div class="container-fluid">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Produtos:</h3>
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tags</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach ($produtos as $produto)
                {
                    echo '<tr>';
                        echo '<td>' . $produto['id'] . '</td>';
                        echo '<td>' . $produto['name'] . '</td>';
                        echo '<td>' . $produto['tags'] . '</td>';

                        echo '<td>';
                        /*
                            echo '<form method="post" action="principal.php?control=tagxproduto&action=cadTagXProduto">';
                                echo '<input type="hidden" name="id" value="' . $produto['id'] . '">';
                                echo '<input type="submit" value="Tags" class="btn btn-success btn-sm float-left">';
                            echo '</form>';
                        */
                            echo '<form method="post" action="principal.php?control=produto&action=cadProduto">';
                                echo '<input type="hidden" name="id" value="' . $produto['id'] . '">';
                                echo '<input type="submit" style="margin-left: 10px" value="Editar" class="btn btn-primary btn-sm float-left">';
                            echo '</form>';
                            echo '<form method="post" action="principal.php?control=produto&action=excProduto">';
                                echo '<input type="hidden" name="id" value="' . $produto['id'] . '">';
                                echo '<input type="submit" style="margin-left: 10px" value="Excluir" class="btn btn-danger btn-sm float-left">';
                            echo '</form>';
                        echo '</td>';

                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>