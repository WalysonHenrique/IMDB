<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllFilmes()
{
    global $conn;
    $query = "SELECT * FROM filmes";
    $filmes = $conn->query($query);
    return $filmes->fetch_all(MYSQLI_ASSOC);
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

function createFilme($titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id, $elenco = [])
{
    global $conn;
    try {
        $conn->begin_transaction();
        $query = "INSERT INTO filmes (titulo, descricao, anoLancamento, categoriaID, idiomaID, classificacao, nacionalidadeID) VALUES (?, ?, ?, ?, ?, ?, ?)";
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
        $filme_id = $conn->insert_id;
        $stmt->close();

        foreach ($elenco as $ator_id) {
            $stmt = $conn->prepare("INSERT INTO filme_has_ator (filmeID, atorID) VALUES (?, ?)");
            $stmt->bind_param("ii", $filme_id, $ator_id);
            $stmt->execute();
            $stmt->close();
        }
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateFilme($id, $titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id, $elenco = [])
{
    global $conn;
    try {
        $conn->begin_transaction();
        $query = "UPDATE filmes SET titulo = ?, descricao = ?, anoLancamento = ?, categoriaID = ?, idiomaID = ?, classificacao = ?, nacionalidadeID = ? WHERE id = ?";
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
        $stmt->close();

        // Remove todos os atores antigos do filme
        $stmt = $conn->prepare("DELETE FROM filme_has_ator WHERE filmeID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Insere os novos atores
        foreach ($elenco as $ator_id) {
            $stmt = $conn->prepare("INSERT INTO filme_has_ator (filmeID, atorID) VALUES (?, ?)");
            $stmt->bind_param("ii", $id, $ator_id);
            $stmt->execute();
            $stmt->close();
        }

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
        $stmt = $conn->prepare("DELETE FROM filme_has_ator WHERE filmeID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM filmes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}
