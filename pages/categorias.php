<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
</head>

<body>
    <?php include_once '../partials/header.php'; ?>

    <?php
    require_once __DIR__ . '/../actions/categoria/categoria_functions.php';
    $categorias = getAllCategorias();
    ?>

    <div class="container mb-5">
        <h1 class="mt-4">Categorias</h1>
        <p>Gerencie as categorias dos filmes aqui.</p>

        <div class="content mt-3">
            <button onclick="location.href='adicionar_categoria.php'" class="btn btn-success mb-3">Adicionar
                Categoria</button>
            <table id="categoriasTable" class="table table-striped">
                <thead>
                    <tr class="table-dark">
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
                                <form action="../actions/categoria/categoria_delete.php" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Tem certeza que deseja deletar esta categoria?');">
                                    <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once '../partials/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#categoriasTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
                }
            });
        });
    </script>
</body>

</html>