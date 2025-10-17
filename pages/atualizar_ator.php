<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Ator - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        include_once '../partials/header.php';
        require_once '../actions/nacionalidade/nacionalidade_functions.php';
        require_once '../actions/ator/ator_functions.php';

        // Pega o ID do ator (por GET ou POST)
        $atorID = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $ator = getAtorById($atorID); // Função que retorna os dados do ator por ID
        $nacionalidades = getAllNacionalidades();
    ?>

    <div class="container mt-5 mb-5">
        <h1>Editar Ator</h1>
        <p>Altere as informações do ator desejado.</p>
        <form action="../actions/ator/ator_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $ator['id']; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" maxlength="70" required
                       value="<?php echo htmlspecialchars($ator['nome'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" class="form-control" maxlength="70" required
                       value="<?php echo htmlspecialchars($ator['sobrenome'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="nascimento" class="form-label">Nascimento</label>
                <input type="date" id="nascimento" name="nascimento" class="form-control" required
                       value="<?php echo htmlspecialchars($ator['nascimento'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select" required>
                    <option value="">Selecione</option>
                    <option value="M" <?php if(($ator['sexo'] ?? '') === 'M') echo 'selected'; ?>>Masculino</option>
                    <option value="F" <?php if(($ator['sexo'] ?? '') === 'F') echo 'selected'; ?>>Feminino</option>
                    <option value="O" <?php if(($ator['sexo'] ?? '') === 'O') echo 'selected'; ?>>Outro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nacionalidadeID" class="form-label">Nacionalidade</label>
                <select name="nacionalidadeID" id="nacionalidadeID" class="form-select" required>
                    <option value="">Selecione</option>
                    <?php foreach ($nacionalidades as $nacionalidade): ?>
                        <option value="<?php echo $nacionalidade['id']; ?>"
                            <?php if(($ator['nacionalidadeID'] ?? '') == $nacionalidade['id']) echo 'selected'; ?>>
                            <?php echo $nacionalidade['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="./atores.php" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>

    <?php include_once '../partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
