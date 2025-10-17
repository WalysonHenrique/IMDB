<?php
require_once __DIR__ . '/nacionalidade_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';
    if (deleteNacionalidade($id)) {
        header('Location: ../../pages/nacionalidades.php?msg=deletado');
    } else {
        header('Location: ../../pages/nacionalidades.php?msg=erro');
    }
    exit;
}
