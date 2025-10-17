<?php
require_once __DIR__ . '/categoria_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteCategoria($id)) {
        header('Location: ../categorias.php?msg=deletado');
    } else {
        header('Location: ../categorias.php?msg=erro');
    }
    exit;
}
