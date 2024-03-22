<?php
namespace App\Repository;


use App\Database\Database;
use App\Model\Cliente;
use PDO;

class ClienteRepository
{
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function insert(Cliente $cliente){
        $nome = $cliente->getNome();
        $email = $cliente->getEmail();
        $cidade = $cliente->getCidade();
        $estado = $cliente->getEstado();

        $query = "INSERT INTO clientes (nome, email, cidade, estado) VALUES (:nome, :email, :cidade, :estado)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":estado", $estado);

        if($stmt->execute())
            return true;
        else
            return false;
    }

    public function getAll(){
        $query = "SELECT * FROM clientes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(Cliente $cliente){
        $id = $cliente->getClienteId();
        $query = "SELECT * FROM clientes WHERE cliente_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Cliente $cliente){
        $id = $cliente->getClienteId();
        $nome = $cliente->getNome();
        $email = $cliente->getEmail();
        $cidade = $cliente->getCidade();
        $estado = $cliente->getEstado();

        $query = "UPDATE clientes SET  nome = :nome, email = :email, cidade = :cidade, estado = :estado WHERE cliente_id = :cliente_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":cliente_id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":estado", $estado);

        if($stmt->execute())
            return true;
        else
            return false;
    }

    public function delete(Cliente $cliente){
        $id = $cliente->getClienteId();
        $query = "DELETE FROM clientes WHERE cliente_id = :cliente_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cliente_id", $id, PDO::PARAM_INT);
        
        if($stmt->execute())
            return true;
        else
            return false;
    }
}