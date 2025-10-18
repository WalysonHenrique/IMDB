<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
</head>

<body>
    <?php
    include_once '../partials/header.php';
    ?>
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }
    ?>
    <?php if ($msg == 'criado'): ?>
        <div class="alert alert-success" role="alert">
            Filme criado com sucesso!
        </div>
    <?php endif; ?>
    <?php if ($msg == 'atualizado'): ?>
        <div class="alert alert-success" role="alert">
            Filme atualizado com sucesso!
        </div>
    <?php endif; ?>
    <?php if ($msg == 'deletado'): ?>
        <div class="alert alert-success" role="alert">
            Filme deletado com sucesso!
        </div>
    <?php endif; ?>
    <?php if ($msg == 'erro'): ?>
        <div class="alert alert-danger" role="alert">
            Ocorreu um erro ao criar o filme.
        </div>
    <?php endif; ?>

    <?php
    require_once __DIR__ . '/../actions/filme/filme_functions.php';
    $filmes = getAllFilmes();
    ?>

    <div class="container mb-5">
        <h1 class="mt-4">Filmes</h1>
        <p>Gerencie os filmes cadastrados aqui.</p>

        <div class="content mt-3">
            <a href="adicionar_filme.php" class="btn btn-success mb-3">Adicionar Filme</a>
            <table id="filmesTable" class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Título</th>
                        <th>Ano</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filmes as $filme): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($filme['id']); ?></td>
                            <td><?php echo htmlspecialchars($filme['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($filme['ano']); ?></td>
                            <td><?php echo htmlspecialchars($filme['categoria_nome'] ?? ''); ?></td>
                            <td>
                                <a href="atualizar_filme.php?id=<?php echo $filme['id']; ?>"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <form action="../actions/filme/filme_delete.php" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Tem certeza que deseja deletar este filme?');">
                                    <input type="hidden" name="id" value="<?php echo $filme['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                </form>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#filmesTable').DataTable({

            });
        });
    </script>
</body>

</html>