<?php
require_once __DIR__ . '/ator_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $nacionalidadeID = $_POST['nacionalidadeID'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';

    if (createAtor($nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento)) {
        header('Location: ../../pages/atores.php?msg=criado');
    } else {
        header('Location: ../../pages/atores.php?msg=erro');
    }
    exit;
}
