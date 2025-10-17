<?php
require_once __DIR__ . '/filme_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $ano_lancamento = $_POST['ano_lancamento'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? '';
    $idioma_id = $_POST['idioma_id'] ?? '';
    $classificacao_indicativa = $_POST['classificacao_indicativa'] ?? '';
    $nacionalidade_id = $_POST['nacionalidade_id'] ?? null;

    if (createFilme($titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id)) {
        header('Location: ../filmes.php?msg=criado');
    } else {
        header('Location: ../filmes.php?msg=erro');
    }
    exit;
}
