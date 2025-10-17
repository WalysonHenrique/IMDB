<?php
require_once __DIR__ . '/nacionalidade_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if (deleteNacionalidade($id)) {
        header('Location: ../nacionalidades.php?msg=deletado');
    } else {
        header('Location: ../nacionalidades.php?msg=erro');
    }
    exit;
}
