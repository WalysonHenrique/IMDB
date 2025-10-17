<?php
require_once __DIR__ . '/nacionalidade_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if (createNacionalidade($nome)) {
        header('Location: ../nacionalidades.php?msg=criado');
    } else {
        header('Location: ../nacionalidades.php?msg=erro');
    }
    exit;
}
