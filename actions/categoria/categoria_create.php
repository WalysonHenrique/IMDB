<?php
require_once __DIR__ . '/categoria_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if (createCategoria($nome)) {
        header('Location: ../categorias.php?msg=criado');
    } else {
        header('Location: ../categorias.php?msg=erro');
    }
    exit;
}
