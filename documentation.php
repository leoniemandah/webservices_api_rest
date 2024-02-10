<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API Documentation</title>
</head>
<body>
    <h1>REST API Documentation</h1>

    <h2>Users</h2>
    <ul>
        <li><a href="#get-all-users">GET /users</a></li>
        <li><a href="#create-user">POST /users</a></li>
        <li><a href="#get-user">GET /users/:id</a></li>
        <li><a href="#update-user">PUT /users/:id</a></li>
        <li><a href="#delete-user">DELETE /users/:id</a></li>
    </ul>

    <h2>Books</h2>
    <ul>
        <li><a href="#get-all-books">GET /livres</a></li>
        <li><a href="#create-book">POST /livres</a></li>
        <li><a href="#get-book">GET /livres/:id</a></li>
        <li><a href="#update-book">PUT /livres/:id</a></li>
        <li><a href="#delete-book">DELETE /livres/:id</a></li>
    </ul>

    <h2 id="get-all-users">GET /users</h2>
    <p>Retrieves all users.</p>

    <h2 id="create-user">POST /users</h2>
    <p>Creates a new user.</p>
    <p>Request body:</p>
    <pre>
    {
        "nom": "John Doe"
    }
    </pre>

    <h2 id="get-user">GET /users/:id</h2>
    <p>Retrieves a specific user by ID.</p>
    <p>Example URL: <code>GET /users/1</code></p>

    <h2 id="update-user">PUT /users/:id</h2>
    <p>Updates an existing user.</p>
    <p>Example URL: <code>PUT /users/1</code></p>
    <p>Request body:</p>
    <pre>
    {
        "nom": "Jane Doe"
    }
    </pre>

    <h2 id="delete-user">DELETE /users/:id</h2>
    <p>Deletes a specific user by ID.</p>
    <p>Example URL: <code>DELETE /users/1</code></p>

    <h2 id="get-all-books">GET /livres</h2>
    <p>Retrieves all books.</p>

    <h2 id="create-book">POST /livres</h2>
    <p>Creates a new book.</p>
    <p>Request body:</p>
    <pre>
    {
        "titre": "The Book",
        "auteur": "Author Name"
    }
    </pre>

    <h2 id="get-book">GET /livres/:id</h2>
    <p>Retrieves a specific book by ID.</p>
    <p>Example URL: <code>GET /livres/1</code></p>

    <h2 id="update-book">PUT /livres/:id</h2>
    <p>Updates an existing book.</p>
    <p>Example URL: <code>PUT /livres/1</code></p>
    <p>Request body:</p>
    <pre>
    {
        "titre": "Updated Book Title",
        "auteur": "Updated Author Name"
    }
    </pre>

        <h2 id="delete-book">DELETE /livres/:id</h2>
    <p>Deletes a specific book by ID.</p>
    <p>Example URL: <code>DELETE /livres/1</code></p>