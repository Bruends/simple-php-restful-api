<?php
  class BooksDB {
    private $dbHost = "localhost";
    private $dbName = "api_books";
    private $dbUser = "root";
    private $dbPass = "root";
    private $pdo;

    public function connect(){
      $pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPass);

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $this->pdo = $pdo;
    }

    public function getAll(){
      $sql = "SELECT * FROM books";
      $this->connect();

      $stmt = $this->pdo->query($sql);

      $this->pdo = null;
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id){
      $sql = "SELECT * FROM books WHERE id=$id";
      $this->connect();

      $stmt = $this->pdo->query($sql);

      $this->pdo = null;
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
  }