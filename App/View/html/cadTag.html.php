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
        <h3><?php echo verdade($novo, 'Novo ', 'Editar '); ?>Tag</h3>
    </div>
    <div class="container-fluid">
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post"
                  action="principal.php?control=tag&action=<?php echo verdade($novo, 'gravarTag', 'atualizarTag'); ?>">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input class="form-control" type="text" id="id" name="id" value="<?php echo $tag['id']; ?>" readonly>
                </div>
                <!-- Nome da Tag-->
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" class="form-control" 
                        name="name" value="<?php echo $tag['name']; ?>" autofocus required 
                        maxlength="50">
                </div>
                <br>
                <button type="submit" value="Gravar" class="btn btn-primary">Gravar</button>
            </form>
        <br>
    </div>
</body>
</html>