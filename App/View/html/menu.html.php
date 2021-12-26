<!DOCTYPE html>
<html>
<?php include 'html' . DIRECTORY_SEPARATOR . 'head.php'; ?>
<body>
    <div class="container-fluid">
        <h3>Sistema de Produtos</h3>
        <p>Olá, <?php echo $_SESSION['usuNome']; ?></p>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link text-white" href="principal.php?action=produtos">Produtos</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=tags">Tags</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=relTags">Relatório de Tags</a>
                    <span class="nav-link text-white">|</span>
                    <a class="nav-link text-white" href="principal.php?action=logout">Sair</a>
                </div>
            </div>
        </nav>
        <br>
        <h3>Totais:</h3>
        <table class="table table-striped table-hover table-sm">
            <tbody>
                <tr>
                    <td><strong>Produtos</strong></td>
                    <td><?php echo $total_produtos; ?></td>
                </tr>
                <tr>
                    <td><strong>Produtos sem Tags</strong></td>
                    <td><?php echo $produtos_sem_tags; ?></td>
                </tr>
                <tr>
                    <td><strong>Tags</strong></td>
                    <td><?php echo $total_tags; ?></td>
                </tr>
                <tr>
                    <td><strong>Tags não atribuídas</strong></td>
                    <td><?php echo $tags_sem_produtos; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>