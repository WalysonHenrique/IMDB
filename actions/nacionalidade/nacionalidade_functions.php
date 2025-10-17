<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllNacionalidades()
{
    global $conn;
    $query = "SELECT * FROM nacionalidades";
    $nacionalidades = $conn->query($query);
    return $nacionalidades->fetch_all(MYSQLI_ASSOC);
}

function getNacionalidadeById($id)
{
    global $conn;
    $query = "SELECT * FROM nacionalidades WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function createNacionalidade($nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO nacionalidades (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateNacionalidade($id, $nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("UPDATE nacionalidades SET nome = ? WHERE id = ?");
        $stmt->bind_param("si", $nome, $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function deleteNacionalidade($id)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM nacionalidades WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}