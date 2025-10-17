<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllAtores()
{
    global $conn;
    $query = "SELECT a.*, n.nome as nacionalidade FROM atores a JOIN nacionalidades n ON a.nacionalidadeID = n.id";
    return $conn->query($query);
}

function getAtorById($id)
{
    global $conn;
    $query = "SELECT * FROM atores WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function createAtor($nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO atores (nome, sobrenome, sexo, nacionalidadeID, nascimento) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateAtor($id, $nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("UPDATE atores SET nome=?, sobrenome=?, sexo=?, nacionalidadeID=?, nascimento=? WHERE id=?");
        $stmt->bind_param("sssisi", $nome, $sobrenome, $sexo, $nacionalidadeID, $nascimento, $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function deleteAtor($id)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM atores WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function getAllNacionalidades()
{
    global $conn;
    $query = "SELECT id, nome FROM nacionalidades ORDER BY nome";
    return $conn->query($query);
}
