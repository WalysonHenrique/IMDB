<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Filme - IMDB</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@4.0.1/dist/css/multi-select-tag.min.css">
    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <?php
    include_once '../partials/header.php';
    require_once '../actions/nacionalidade/nacionalidade_functions.php';
    require_once '../actions/idioma/idioma_functions.php';
    require_once __DIR__ . '/../actions/categoria/categoria_functions.php';
    require_once __DIR__ . '/../actions/ator/ator_functions.php';
    $categorias = getAllCategorias();
    $idiomas = getAllIdiomas();
    $nacionalidades = getAllNacionalidades();
    $atores = getAllAtores();
    ?>

    <div class="container mt-5 mb-5">
        <h1>Adicionar Filme</h1>
        <p>Preencha as informações do novo filme.</p>
        <form action="../actions/filme/filme_create.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Digite o título do filme"
                    maxlength="70" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control"
                    placeholder="Fale mais sobre o filme aqui" maxlength="70" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ano_lancamento" class="form-label">Ano de Lançamento</label>
                <input type="number" id="ano_lancamento" name="ano_lancamento" class="form-control" min="1000"
                    max="2025" required>
            </div>
            <div class="mb-3">
                <label for="classificacao" class="form-label">Classificação Indicativa</label>
                <input type="number" id="classificacao" name="classificacao_indicativa" class="form-control"
                    maxlength="10" required>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Selecione</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nacionalidade" class="form-label">Nacionalidade</label>
                <select name="nacionalidade_id" id="nacionalidadeID" class="form-select" required>
                    <option value="">Selecione</option>
                    <?php foreach ($nacionalidades as $nacionalidade): ?>
                        <option value="<?php echo $nacionalidade['id']; ?>"><?php echo $nacionalidade['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idioma" class="form-label">Idioma</label>
                <select name="idioma_id" id="idiomaID" class="form-select" required>
                    <option value="">Selecione</option>
                    <?php foreach ($idiomas as $idioma): ?>
                        <option value="<?php echo $idioma['id']; ?>"><?php echo $idioma['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="elenco" class="form-label">Elenco</label>
                <select name="elenco[]" id="elenco" class="form-select" multiple required>
                    <?php foreach ($atores as $ator): ?>
                        <option value="<?php echo $ator['id']; ?>"><?php echo $ator['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./atores.php" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>

    <?php include_once '../partials/footer.php'; ?>
    <script
        src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@4.0.1/dist/js/multi-select-tag.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tagSelector = new MultiSelectTag('elenco', {
            maxSelection: 10,
            required: true,
            placeholder: 'Pesquise os atores',
            onChange: function (selected) {
                console.log('Selection changed:', selected);
            }
        });
    </script>
</body>

</html>