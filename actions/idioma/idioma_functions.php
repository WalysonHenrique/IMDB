<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllIdiomas()
{
    global $conn;
    $query = "SELECT * FROM idiomas";
    $idiomas = $conn->query($query);
    return $idiomas->fetch_all(MYSQLI_ASSOC);
}

function getIdiomaById($id)
{
    global $conn;
    $query = "SELECT * FROM idiomas WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function createIdioma($nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO idiomas (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateIdioma($id, $nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("UPDATE idiomas SET nome = ? WHERE id = ?");
        $stmt->bind_param("si", $nome, $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function deleteIdioma($id)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM idiomas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}
