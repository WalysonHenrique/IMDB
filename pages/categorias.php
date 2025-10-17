<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <?php
    include_once '../partials/header.php';
    ?>

    <?php
    require_once __DIR__ . '/../actions/categoria/categoria_functions.php';
    $categorias = getAllCategorias();
    ?>

    <div class="container">
        <h1 class="mt-4">Categorias</h1>
        <p>Gerencie as categorias dos filmes aqui.</p>

        <div class="content">


        </div>
    </div>

    <?php
    include_once '../partials/footer.php';
    ?>
</body>

</html>

</div>
</div>

<?php
include_once '../partials/footer.php';
?>

<div class="container">
    <h1 class="mt-4">Categorias</h1>
    <p>Gerencie as categorias dos filmes aqui.</p>

    <div class="content">
        <!-- quero usar o new dataTable -->
        <table id="categoriasTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($categoria['id']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>"
                                class="btn btn-sm btn-primary">Editar</a>
                            <a href="deletar_categoria.php?id=<?php echo $categoria['id']; ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja deletar esta categoria?');">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once '../partials/footer.php';
?>


<script>
    $(document).ready(function () {
        $('#categoriasTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });
</script>
</body>

</html>