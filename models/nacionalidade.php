<?php 

namespace Models;
require 'utils/Database.php';
use Utils\Database;



class Nacionalidade{
    private $id;
    private $nome;

    private $conn;
    



    public function __construct($id, $nome){
        $this->id = $id;
        $this->nome = $nome;
        $this->conn = Database::getConn();
    }


    /**
     * @return Nacionalidade[]
     */
    public function listar(): array{
        try{
            $query = "select * from nacionalidades";

            $result = $this->conn->query($query);
            $nacionalidades = $result->fetch_all(MYSQLI_ASSOC);
            return $nacionalidades;
        } catch (\mysqli_sql_exception $e) {
            return [];
        }
    }

    public function atualizar($id): bool{
        try{
            $query = "update nacionalidades set nome = '$this->nome' where id = $this->id";
            $this->conn->query($query);
            return true;
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
    }

    public function criar(){}


    public function excluir($id){
        try {
            
            
            $query = "delete from nacionalidades where id = $id";
            $this->conn->query($query);
            return true;

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    
}