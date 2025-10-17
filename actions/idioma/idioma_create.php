<?php
require_once __DIR__ . '/idioma_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if (createIdioma($nome)) {
        header('Location: ../idiomas.php?msg=criado');
    } else {
        header('Location: ../idiomas.php?msg=erro');
    }
    exit;
}
