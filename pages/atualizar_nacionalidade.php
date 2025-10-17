<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Nacionalidade - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reset.css">
</head>
<body>
    <?php
        include_once '../partials/header.php';
        require_once '../actions/nacionalidade/nacionalidade_functions.php';
        $nacionalidadeID = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $nacionalidade = getNacionalidadeById($nacionalidadeID);
    ?>

    <div class="container mt-5 mb-5">
        <h1>Editar Nacionalidade</h1>
        <p>Altere as informações da nacionalidade desejada.</p>
        <form action="../actions/nacionalidade/nacionalidade_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $nacionalidade['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" maxlength="70" required
                       value="<?php echo htmlspecialchars($nacionalidade['nome'] ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="./nacionalidades.php" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>

    <?php include_once '../partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
