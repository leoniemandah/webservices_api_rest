<?php
header('Content-Type: text/html');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API Documentation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.39.2/swagger-ui.css">
</head>

<body>
    <div id="swagger-ui"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.39.2/swagger-ui-bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.39.2/swagger-ui-standalone-preset.js"></script>
    <script>
        var spec = {
            "openapi": "3.0.0",
            "info": {
                "title": "REST API Documentation",
                "version": "1.0.0",
                "description": "API Documentation for the REST API"
            },
            "paths": {
                "/users": {
                    "get": {
                        "description": "Retrieve all users",
                        "responses": {
                            "200": {
                                "description": "Successfully retrieved all users",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "array",
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "id": {
                                                        "type": "integer",
                                                        "description": "Unique identifier for the user"
                                                    },
                                                    "nom": {
                                                        "type": "string",
                                                        "description": "The user's name"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "post": {
                        "description": "Create a new user",
                        "requestBody": {
                            "description": "User data",
                            "content": {
                                "application/json": {
                                    "schema": {
                                        "type": "object",
                                        "properties": {
                                            "nom": {
                                                "type": "string",
                                                "description": "The user's name"
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        "responses": {
                            "201": {
                                "description": "Successfully created a new user",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "object",
                                            "properties": {
                                                "message": {
                                                    "type": "string",
                                                    "description": "Message indicating successful creation"
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "/livres": {
                    "get": {
                        "description": "Retrieve all books",
                        "responses": {
                            "200": {
                                "description": "Successfully retrieved all books",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "array",
                                            "items": {
                                                "type": "object",
                                                "properties": {
                                                    "id": {
                                                        "type": "integer",
                                                        "description": "Unique identifier for the book"
                                                    },
                                                    "titre": {
                                                        "type": "string",
                                                        "description": "The book's title"
                                                    },
                                                    "auteur": {
                                                        "type": "string",
                                                        "description": "The book's author"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "post": {
                        "description": "Create a new book",
                        "requestBody": {
                            "description": "Book data",
                            "content": {
                                "application/json": {
                                    "schema": {
                                        "type": "object",
                                        "properties": {
                                            "titre": {
                                                "type": "string",
                                                "description": "The book's title"
                                            },
                                            "auteur": {
                                                "type": "string",
                                                "description": "The book's author"
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        "responses": {
                            "201": {
                                "description": "Successfully created a new book",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "object",
                                            "properties": {
                                                "message": {
                                                    "type": "string",
                                                    "description": "Message indicating successful creation"
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "put": {
                        "description": "Update an existing book",
                        "requestBody": {
                            "description": "Book data",
                            "content": {
                                "application/json": {
                                    "schema": {
                                        "type": "object",
                                        "properties": {
                                            "id": {
                                                "type": "integer",
                                                "description": "Unique identifier for the book"
                                            },
                                            "titre": {
                                                "type": "string",
                                                "description": "The book's title (optional)"
                                            },
                                            "auteur": {
                                                "type": "string",
                                                "description": "The book's author (optional)"
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        "responses": {
                            "200": {
                                "description": "Successfully updated the book details",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "object",
                                            "properties": {
                                                "message": {
                                                    "type": "string",
                                                    "description": "Message indicating successful update"
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "delete": {
                        "description": "Delete an existing book",
                        "responses": {
                            "200": {
                                "description": "Successfully deleted the book",
                                "content": {
                                    "application/json": {
                                        "schema": {
                                            "type": "object",
                                            "properties": {
                                                "message": {
                                                    "type": "string",
                                                    "description": "Message indicating successful deletion"
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        };

        const ui = SwaggerUIBundle({
            spec: spec,
            dom_id: '#swagger-ui',
            deepLinking: true,
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrlPlugin()
            ],
            layout: "StandaloneLayout"
        });
    </script>
</body>

</html>