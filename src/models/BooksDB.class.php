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

    public function add(string $title, string $author, string $description){
      $sql = "INSERT INTO books Values (default, :title, :author, :book_description)";
      
      $this->connect();

      $stmt = $this->pdo->prepare($sql);

      $res = $stmt->execute(array(
         ":title" => $title,
         ":author" => $author,
         ":book_description" => $description,
        )
      );      
    }
   
    public function update($id, string $title, string $author, string $description){
      $sql = "UPDATE books SET title = :title, author = :author, book_description = :book_description WHERE id = :id";
      
      $this->connect();

      $stmt = $this->pdo->prepare($sql);

      $res = $stmt->execute(array(
         ":id" => $id,
         ":title" => $title,
         ":author" => $author,
         ":book_description" => $description,
        )
      );      
  }       
   
    public function delete($id){
      $sql = "DELETE FROM books WHERE id= :id";

      $this->connect();
      
      $stmt = $this->pdo->prepare($sql);      
      $res = $stmt->execute(array( ":id" => $id ));      
  }       
}