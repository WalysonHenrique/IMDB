<?php
require_once __DIR__ . '/idioma_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if (createIdioma($nome)) {
        header('Location: ../../pages/idiomas.php?msg=criado');
    } else {
        header('Location: ../../pages/idiomas.php?msg=erro');
    }
    exit;
}
