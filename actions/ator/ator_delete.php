<?php
require_once __DIR__ . '/ator_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteAtor($id)) {
        header('Location: ../atores.php?msg=deletado');
    } else {
        header('Location: ../atores.php?msg=erro');
    }
    exit;
}
