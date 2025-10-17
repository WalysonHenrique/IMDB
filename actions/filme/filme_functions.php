<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllFilmes()
{
    global $conn;
    $query = "SELECT * FROM filmes";
    return $conn->query($query);
}

function getFilmeById($id)
{
    global $conn;
    $query = "SELECT * FROM filmes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function createFilme($titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id = null)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $query = "INSERT INTO filmes (titulo, descricao, ano_lancamento, categoria_id, idioma_id, classificacao_indicativa, nacionalidade_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($nacionalidade_id === null || $nacionalidade_id === '') {
            $nacionalidade_id = null;
        }
        $stmt->bind_param(
            "ssiissi",
            $titulo,
            $descricao,
            $ano_lancamento,
            $categoria_id,
            $idioma_id,
            $classificacao_indicativa,
            $nacionalidade_id
        );
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateFilme($id, $titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id = null)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $query = "UPDATE filmes SET titulo = ?, descricao = ?, ano_lancamento = ?, categoria_id = ?, idioma_id = ?, classificacao_indicativa = ?, nacionalidade_id = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        if ($nacionalidade_id === null || $nacionalidade_id === '') {
            $nacionalidade_id = null;
        }
        $stmt->bind_param(
            "ssiissii",
            $titulo,
            $descricao,
            $ano_lancamento,
            $categoria_id,
            $idioma_id,
            $classificacao_indicativa,
            $nacionalidade_id,
            $id
        );
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function deleteFilme($id)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM filmes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}
