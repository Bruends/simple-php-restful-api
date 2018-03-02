<?php
require __DIR__ . '/../../configDB.php';

  class BooksDB {    
    private $pdo;

    public function connect(){
      $connect_str = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

      $pdo = new PDO($connect_str, DB_USER, DB_PASSWORD);

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $this->pdo = $pdo;
    }

    public function getAll(){
      $sql = "SELECT id, title, author, book_description FROM books";
      $this->connect();

      $stmt = $this->pdo->query($sql);

      $this->pdo = null;
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id){
      $sql = "SELECT id, title, author, book_description FROM books WHERE id=$id";
      $this->connect();

      $stmt = $this->pdo->query($sql);

      $this->pdo = null;
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(Book $book){
      $sql = "INSERT INTO books Values (default, :title, :author, :book_description)";
      
      $this->connect();

      $stmt = $this->pdo->prepare($sql);

      $res = $stmt->execute(array(
         ":title" => $book->__get('title'),
         ":author" => $book->__get('author'),
         ":book_description" => $book->__get('description'),
        )
      );      
    }
   
    public function update(Book $book){
      $sql = "UPDATE books SET title = :title, author = :author, book_description = :book_description WHERE id = :id";
      
      $this->connect();

      $stmt = $this->pdo->prepare($sql);

      $res = $stmt->execute(array(
         ":id" => $book->__get('id'),
         ":title" => $book->__get('title'),
         ":author" => $book->__get('author'),
         ":book_description" => $book->__get('description'),
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