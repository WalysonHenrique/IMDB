<?php

require_once __DIR__ . '/../../utils/Database.php';

global $conn;
$conn = getConn();

function getAllCategorias()
{
    global $conn;
    $query = "SELECT * FROM categorias";
    $categorias = $conn->query($query);
    return $categorias->fetch_all(MYSQLI_ASSOC);
}

function getCategoriaById($id)
{
    global $conn;
    $query = "SELECT * FROM categorias WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createCategoria($nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function updateCategoria($id, $nome)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
        $stmt->bind_param("si", $nome, $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}

function deleteCategoria($id)
{
    global $conn;
    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->commit();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $conn->rollback();
        return false;
    }
}
