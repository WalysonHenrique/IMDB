<?php
require_once __DIR__ . '/nacionalidade_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    if (updateNacionalidade($id, $nome)) {
        header('Location: ../../pages/nacionalidades.php?msg=atualizado');
    } else {
        header('Location: ../../pages/nacionalidades.php?msg=erro');
    }
    exit;
}
