<?php
require_once __DIR__ . '/filme_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteFilme($id)) {
        header('Location: ../../pages/filmes.php?msg=deletado');
    } else {
        header('Location: ../../pages/filmes.php?msg=erro');
    }
    exit;
}
