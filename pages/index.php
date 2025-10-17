<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <style>
        .cards-wrapper {
            display: flex;
            justify-content: center;
        }

        .card {
            margin: 0 0.5em;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(22, 22, 26, 0.15);
            transition:
                transform 0.2s,
                box-shadow 0.2s;
            min-width: 260px;
            max-width: 320px;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 24px rgba(22, 22, 26, 0.22);
        }

        .card-img-top {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            height: 180px;
            object-fit: cover;
        }

        .card-title {
            font-weight: bold;
            color: #0d6efd;
        }

        .card-body {
            padding: 1.2em;
        }

        .badge-categoria {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #ffc107;
            color: #222;
            font-size: 0.85em;
            padding: 0.4em 0.8em;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(22, 22, 26, 0.12);
        }

        .card {
            position: relative;
        }

        .carousel-inner {
            padding: 1em;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: #e1e1e1;
            width: 5vh;
            height: 5vh;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        @media (min-width: 768px) {
            .card img {
                height: 11em;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once '../partials/header.php';
    ?>

    <?php
    include_once '../actions/filme/filme_functions.php';
    require_once __DIR__ . '/../actions/categoria/categoria_functions.php';
    $filmes = getAllFilmes();

    $categorias = getAllCategorias();

    $filmesPorCategoria = [];
    foreach ($categorias as $categoria) {
        $filmesPorCategoria[$categoria['id']] = [];
    }
    foreach ($filmes as $filme) {
        if (isset($filmesPorCategoria[$filme['categoriaID']])) {
            $filmesPorCategoria[$filme['categoriaID']][] = $filme;
        }
    }
    ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Filmes por Categoria</h2>
        <?php
        if (count($filmes) === 0):
            echo "
            <div class='d-flex justify-content-center align-items-center alert alert-warning' role='alert'>
                <p class='text-center'>Nenhum filme encontrado.</p>
            </div>";
        else:
            foreach ($categorias as $categoria): ?>
                <?php if (count($filmesPorCategoria[$categoria['id']]) > 0): ?>
                    <h3 class="mt-5 mb-3 text-primary"><?= htmlspecialchars($categoria['nome']) ?></h3>
                    <div id="carouselCategoria<?= $categoria['id'] ?>" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $filmesCat = $filmesPorCategoria[$categoria['id']];
                            $chunks = array_chunk($filmesCat, 3);

                            foreach ($chunks as $i => $grupoFilmes):
                                ?>
                                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                    <div class="cards-wrapper">
                                        <?php foreach ($grupoFilmes as $filme): ?>
                                            <div class="card">
                                                <span class="badge-categoria"><?= htmlspecialchars($categoria['nome']) ?></span>
                                                <img src="../assets/img/logo_padrao.png" width="100%" height="180" class="card-img-top"
                                                    alt="<?= htmlspecialchars($filme['titulo']) ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= htmlspecialchars($filme['titulo']) ?></h5>
                                                    <p class="card-text">Ano:
                                                        <?= htmlspecialchars(date('Y', strtotime($filme['anoLancamento']))) ?>
                                                    </p>
                                                    <a href="#" class="btn btn-primary w-100">Ver detalhes</a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselCategoria<?= $categoria['id'] ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselCategoria<?= $categoria['id'] ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Próximo</span>
                        </button>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php
    include_once '../partials/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>