<?php
namespace Models;
require 'utils/Database.php';
use Utils\Database;

class Filme
{
    private $conn;
    private $id;
    private $titulo;
    private $descricao;
    private $ano_lancamento;
    private $categoria_id;
    private $idioma_id;
    private $classificacao_indicativa;
    private $nacionalidade_id;
    public function __construct()
    {
        $this->conn = Database::getConn();
    }

    public function getAllFilmes()
    {
        $query = "SELECT * FROM filmes";
        return $this->conn->query($query);
    }

    public function getFilmeById($id)
    {
        $query = "SELECT * FROM filmes WHERE id = $id";
        return $this->conn->query($query);
    }

    public function createFilme($titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id = null)
    {
        try {
            $this->conn->begin_transaction();

            $nacionalidade_part = is_null($nacionalidade_id) ? "NULL" : $nacionalidade_id;
            $query = "INSERT INTO filmes (titulo, descricao, ano_lancamento, categoria_id, idioma_id, classificacao_indicativa, nacionalidade_id) 
                      VALUES ('$titulo', '$descricao', $ano_lancamento, $categoria_id, $idioma_id, '$classificacao_indicativa', $nacionalidade_part)";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function updateFilme($id, $titulo, $descricao, $ano_lancamento, $categoria_id, $idioma_id, $classificacao_indicativa, $nacionalidade_id = null)
    {
        try {
            $this->conn->begin_transaction();

            $nacionalidade_part = is_null($nacionalidade_id) ? "NULL" : $nacionalidade_id;
            $query = "UPDATE filmes 
                      SET titulo = '$titulo', descricao = '$descricao', ano_lancamento = $ano_lancamento, 
                          categoria_id = $categoria_id, idioma_id = $idioma_id, 
                          classificacao_indicativa = '$classificacao_indicativa', nacionalidade_id = $nacionalidade_part
                      WHERE id = $id";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function deleteFilme($id)
    {
        try {
            $this->conn->begin_transaction();

            $query = "DELETE FROM filmes WHERE id = $id";
            $this->conn->query($query);

            $this->conn->commit();
            return true;
        } catch (\mysqli_sql_exception $e) {
            $this->conn->rollback();
            return false;
        }
    }
}
