<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idiomas - IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <?php
    include_once '../partials/header.php';
    require_once '../actions/idioma/idioma_functions.php';
    $idiomas = getAllIdiomas();
    ?>

  
    <div class="container">
    <h1 class="mt-4">Idiomas</h1>
    <p>Gerencie os idiomas dos filmes aqui.</p>

    <div class="content">
        <!-- quero usar o new dataTable -->
        <table id="idiomasTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($idiomas as $idioma): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($idioma['id']); ?></td>
                        <td><?php echo htmlspecialchars($idioma['nome']); ?></td>
                        <td>
                            <a href="editar_idioma.php?id=<?php echo $idioma['id']; ?>"
                                class="btn btn-sm btn-primary">Editar</a>
                            <a href="deletar_idioma.php?id=<?php echo $idioma['id']; ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja deletar este idioma?');">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    
</body>





<?php
include_once '../partials/footer.php';
?>

<script>
    $(document).ready(function () {
        $('#idiomasTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });
    });
</script>

</html>