<?php
require_once __DIR__ . '/categoria_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    if (updateCategoria($id, $nome)) {
        header('Location: ../categorias.php?msg=atualizado');
    } else {
        header('Location: ../categorias.php?msg=erro');
    }
    exit;
}
