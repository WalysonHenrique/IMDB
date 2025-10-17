<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nacionalidades - IMDB</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../assets/css/reset.css">


    </head>

    <body>
        <?php
        include_once '../partials/header.php';
        require_once '../actions/nacionalidade/nacionalidade_functions.php';
        $nacionalidades = getAllNacionalidades();
        ?>

    
        <div class="container mb-5">
            <h1 class="mt-4">Nacionalidades</h1>
            <p>Gerencie as nacionalidades dos filmes aqui.</p>

            <div class="content mt-3">
                <!-- quero usar o new dataTable -->
                <table id="nacionalidadesTable" class="table table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nacionalidades as $nacionalidade): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($nacionalidade['id']); ?></td>
                                <td><?php echo htmlspecialchars($nacionalidade['nome']); ?></td>
                                <td>
                                    <a href="editar_nacionalidade.php?id=<?php echo $nacionalidade['id']; ?>"
                                        class="btn btn-sm btn-primary">Editar</a>
                                    <a href="deletar_nacionalidade.php?id=<?php echo $nacionalidade['id']; ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tem certeza que deseja deletar esta nacionalidade?');">Deletar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


    <?php
        include_once '../partials/footer.php';
    ?>

    
    <script>
        $(document).ready(function () {
            $('#nacionalidadesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
                }
            });
        });
    </script>

</body>
</html>