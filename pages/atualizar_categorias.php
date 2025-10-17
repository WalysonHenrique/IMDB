<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Categoria - IMDB</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once '../partials/header.php';
    require_once '../actions/categoria/categoria_functions.php';

    $categoriaID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $categoria = getCategoriaById($categoriaID);
    ?>

    <div class="container mt-5 mb-5">
        <h1>Editar Categoria</h1>
        <p>Altere as informações da categoria desejada.</p>
        <form action="../actions/categoria/categoria_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" maxlength="70" required
                    value="<?php echo htmlspecialchars($categoria['nome'] ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="./categorias.php" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>

    <?php include_once '../partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>