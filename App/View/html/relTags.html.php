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
                    <a class="nav-link text-white" href="principal.php?action=produtos">Produtos</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=tags">Tags</a>
                </div>
            </div>
        </nav>
        <br>
    </div>
    <div class="container-fluid">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Relatório de Tags:</h3>
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Total de produtos</th>
                    <th>Produtos (em ordem de relevância)</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach ($tags as $tag)
                {
                    echo '<tr>';
                        echo '<td>' . $tag['id'] . '</td>';
                        echo '<td>' . $tag['name'] . '</td>';
                        echo '<td>' . $tag['qtd_produtos'] . '</td>';
                        echo '<td>' . $tag['produtos'] . '</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>