<?php
require_once __DIR__ . '/idioma_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    if (updateIdioma($id, $nome)) {
        header('Location: ../../pages/idiomas.php?msg=atualizado');
    } else {
        header('Location: ../../pages/idiomas.php?msg=erro');
    }
    exit;
}
