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


        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
        }else{
            $msg = '';
        }
        ?>



        <?php if($msg == 'criado'): ?>
            <div class="alert alert-success" role="alert">
                Nacionalidade criada com sucesso!
            </div>
        <?php endif; ?>
        <?php if($msg == 'atualizado'): ?>
            <div class="alert alert-success" role="alert">
                Nacionalidade atualizada com sucesso!
            </div>
        <?php endif; ?>
        <?php if($msg == 'deletado'): ?>
            <div class="alert alert-success" role="alert">
                Nacionalidade deletada com sucesso!
            </div>
        <?php endif; ?>
         <?php if($msg == 'erro'): ?>
            <div class="alert alert-danger" role="alert">
                Ocorreu um erro ao realizar a operação.
            </div>
        <?php endif; ?>

    
        <div class="container mb-5">
            <h1 class="mt-4">Nacionalidades</h1>
            <p>Gerencie as nacionalidades dos filmes aqui.</p>
            <button onclick="location.href='./adicionar_nacionalidade.php'" class="btn btn-primary mb-3">Adicionar Nacionalidade</button>



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
                                    <a href="./atualizar_nacionalidade.php?id=<?php echo $nacionalidade['id']; ?>"
                                        class="btn btn-sm btn-primary">Editar</a>
                                    <a href="../actions/nacionalidade/nacionalidade_delete.php?id=<?php echo $nacionalidade['id']; ?>" class="btn btn-sm btn-danger"
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