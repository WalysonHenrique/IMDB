<?php
require_once __DIR__ . '/idioma_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteIdioma($id)) {
        header('Location: ../idiomas.php?msg=deletado');
    } else {
        header('Location: ../idiomas.php?msg=erro');
    }
    exit;
}
