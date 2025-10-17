<?php
require_once __DIR__ . '/ator_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $nacionalidadeID = $_POST['nacionalidadeID'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';

    if (updateAtor($id, $nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento)) {
        header('Location: ../atores.php?msg=atualizado');
    } else {
        header('Location: ../atores.php?msg=erro');
    }
    exit;
}
