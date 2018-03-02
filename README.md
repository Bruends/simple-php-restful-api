# Books api

simple CRUD rest api with slim php and mysql


### installing and running:

- first check if you have `php >= 7`, `mysql` and `composer` installed 

- create a database in sql and execute the querys in the `books.sql` file to create the table.

- change database config in `configDB.php`.

- Install the dependencies with:
`composer install`

- After previous steps, open the api folder in terminal and start the server with the command:
`php -S localhost:4000`



### Endpoints:

#### api path: `http://localhost:4000/index.php/books`

##### all books:
> GET &nbsp;&nbsp; /books

##### on book by id:
> GET &nbsp;&nbsp; /books/{id}

##### add book:
> POST &nbsp;&nbsp; /books

and send the body with the json in this format:

```
{
    title: String, (required)
    author: String,
    book_description: string
}
```

##### update book:
> PUT &nbsp;&nbsp; /books

and send the body with the json in this format:

```
{
    id: int, (required),
    title: String, (required)
    author: String,
    book_description: string
}
```

##### delete book:
> DELETE &nbsp;&nbsp; /books/{id}


