<?php

namespace Models;
require 'utils/Database.php';
use Utils\Database;

class Categoria
{
    private $conn;
    private $id;
    private $nome;

    public function __construct()
    {
        $this->conn = Database::getConn();
    }

    public function getAllCategorias()
    {
        $query = "SELECT * FROM categorias";
        return $this->conn->query($query);
    }

    public function getCategoriaById($id)
    {
        $query = "SELECT * FROM categorias WHERE id = $id";
        return $this->conn->query($query);
    }

    public function createCategoria($nome)
    {
        try {
            $this->conn->begin_transaction();

            $query = "INSERT INTO categorias (nome) VALUES ('$nome')";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function updateCategoria($id, $nome)
    {
        try {
            $this->conn->begin_transaction();

            $query = "UPDATE categorias SET nome = '$nome' WHERE id = $id";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function deleteCategoria($id)
    {
        try {
            $this->conn->begin_transaction();

            $query = "DELETE FROM categorias WHERE id = $id";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
