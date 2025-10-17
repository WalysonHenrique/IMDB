<?php
require_once __DIR__ . '/filme_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteFilme($id)) {
        header('Location: ../filmes.php?msg=deletado');
    } else {
        header('Location: ../filmes.php?msg=erro');
    }
    exit;
}
