<?php
require_once __DIR__ . '/filme_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $ano_lancamento = $_POST['ano_lancamento'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? '';
    $idioma_id = $_POST['idioma_id'] ?? '';
    $classificacao_indicativa = $_POST['classificacao_indicativa'] ?? '';
    $nacionalidade_id = $_POST['nacionalidade_id'] ?? null;
    $elenco = $_POST['elenco'] ?? [];

    if (updateFilme($id, $titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id, $elenco)) {
        header('Location: ../../pages/filmes.php?msg=atualizado');
    } else {
        header('Location: ../../pages/filmes.php?msg=erro');
    }
    exit;
}
