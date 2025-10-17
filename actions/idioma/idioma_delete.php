<?php
require_once __DIR__ . '/idioma_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';
    if (deleteIdioma($id)) {
        header('Location: ../../pages/idiomas.php?msg=deletado');
    } else {
        header('Location: ../../pages/idiomas.php?msg=erro');
    }
    exit;
}
