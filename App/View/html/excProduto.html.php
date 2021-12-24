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
        <h3>Tem certeza que deseja excluir o Produto?</h3>
    </div>
    <div class="container-fluid">
        <?php include_once 'lib/mensagem.php'; ?>
        <p><strong><?php echo $produto['id'] . ' - ' . $produto['name']; ?></strong></p>
        <br>
        <form method="post" action="principal.php?control=produto&action=excluirProduto">
            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
            <button type="submit" value="Sim" class="btn btn-danger float-left">Sim</button>
        </form>

        <a class="btn btn-primary float-left" style="margin-left: 30px" href="principal.php?action=produtos">Não</a>
    </div>
</body>
</html>