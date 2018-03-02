<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/models/BooksDB.class.php';
require 'src/Book.class.php';

$app = new \Slim\App;

// Routes
// all books
$app->get('/books', function (Request $request, Response $response) {    
  try {
    // picking books from database 
    $booksDb = new BooksDB();
    $books = $booksDb->getAll();

    // custom json response
    $response->withStatus(200);
    $response->withHeader('Content-Type', 'application/json');
    return $response->withJson($books);

  } catch (PDOException $e) {
    $response->withStatus(500);
    $response->withHeader('Content-Type', 'application/json');
    $error['err'] = $e->getMessage();
    return $response->withJson($error);
  }
});

// get one book by id
$app->get('/books/{id}', function (Request $request, Response $response) {
  try {
    $id = $request->getAttribute('id');

    // picking a book
    $booksDb = new BooksDB();    
    $book = $booksDb->findById($id);

    // custom json response
    $response->withStatus(200);
    $response->withHeader('Content-Type', 'application/json');
    return $response->withJson($book);

  } catch (PDOException $e) {
    $response->withStatus(500);
    $response->withHeader('Content-Type', 'application/json');
    $error['err'] = $e->getMessage(); 
    return $response->withJson($error);
  }
});

// adding a book
$app->post('/books', function (Request $request, Response $response) { 
  try {
    $book = new Book();    
    $book->__set('title', $request->getParam('title'));
    $book->__set('author', $request->getParam('author'));
    $book->__set('description', $request->getParam('book_description'));

    // adding book in db
    $booksDb = new BooksDB();
    $booksDb->add($book);

    // custom json response
    $response->withStatus(200);
    $response->withHeader('Content-Type', 'application/json');
    $message['ok'] = "Book added successfully";
    return $response->withJson($message);

  } catch (PDOException $e) {
    $response->withStatus(500);
    $response->withHeader('Content-Type', 'application/json');
    $error['err'] = $e->getMessage(); 
    return $response->withJson($error);
  }
});

// update a book
$app->put('/books', function (Request $request, Response $response) { 
  try {

    $book = new Book();
    $book->__set('id', $request->getParam('id'));
    $book->__set('title', $request->getParam('title'));
    $book->__set('author', $request->getParam('author'));
    $book->__set('book_description', $request->getParam('description'));


    // updating book in db
    $booksDb = new BooksDB();
    $booksDb->update($book);

    // custom json response
    $response->withStatus(200);
    $response->withHeader('Content-Type', 'application/json');
    $message['ok'] = "Book updated successfully";
    return $response->withJson($message);

  } catch (PDOException $e) {
    $response->withStatus(500);
    $response->withHeader('Content-Type', 'application/json');
    $error['err'] = $e->getMessage(); 
    return $response->withJson($error);
  }
});
// delete a book
$app->delete('/books/{id}', function (Request $request, Response $response) { 
  try {
    $id = $request->getAttribute('id');
    
    // delete book from database 
    $booksDb = new BooksDB();
    $booksDb->delete($id);

    // custom json response
    $response->withStatus(200);
    $response->withHeader('Content-Type', 'application/json');
    $message['ok'] = "Book deleted successfully";
    return $response->withJson($message);

  } catch (PDOException $e) {
    $response->withStatus(500);
    $response->withHeader('Content-Type', 'application/json');
    $error['err'] = $e->getMessage();
    return $response->withJson($error);
  }
});

$app->run();