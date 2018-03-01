<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/models/BooksDB.class.php';

$app = new \Slim\App;

// all books
$app->get('/books', function (Request $request, Response $response) {    
    try {
        // picking books from database 
        $usersDb = new BooksDB();    
        $books = $usersDb->getAll();

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

// one book by id
$app->get('/books/{id}', function (Request $request, Response $response) {      try {
        $id = $request->getAttribute('id');

        // picking book from database 
        $usersDb = new BooksDB();    
        $book = $usersDb->findById($id);

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
$app->get('/books/{id}', function (Request $request, Response $response) {      try {
        $title = $request->getAttribute('id');
        $author = $request->getAttribute('author');
        $description = $request->getAttribute('description');

        // picking book from database 
        $usersDb = new BooksDB();    
        $book = $usersDb->findById($id);

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

$app->run();