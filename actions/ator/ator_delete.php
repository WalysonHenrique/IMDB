<?php
require_once __DIR__ . '/ator_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';
    if (deleteAtor($id)) {
        header('Location: ../../pages/atores.php?msg=deletado');
    } else {
        header('Location: ../../pages/atores.php?msg=erro');
    }
    exit;
}
