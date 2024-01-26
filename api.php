<?php

header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "rest_api");

// Vérifie la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

// Route pour récupérer tous les utilisateurs (Read - GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $mysqli->query("SELECT * FROM utilisateurs");
    $utilisateurs = [];
    
    while ($row = $result->fetch_assoc()) {
        $utilisateurs[] = $row;
    }

    echo json_encode($utilisateurs);
}

// Route pour créer un nouvel utilisateur (Create - POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $data['nom'];
    $email = $data['email'];

    $stmt = $mysqli->prepare("INSERT INTO utilisateurs (nom, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nom, $email);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Utilisateur créé avec succès']);
    } else {
        echo json_encode(['error' => 'Erreur lors de la création de l\'utilisateur']);
    }
}

// Route pour mettre à jour un utilisateur (Update - PUT)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $nom = $data['nom'];
    $email = $data['email'];

    $stmt = $mysqli->prepare("UPDATE utilisateurs SET nom=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $nom, $email, $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Utilisateur mis à jour avec succès']);
    } else {
        echo json_encode(['error' => 'Erreur lors de la mise à jour de l\'utilisateur']);
    }
}

// Route pour supprimer un utilisateur (Delete - DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];

    $stmt = $mysqli->prepare("DELETE FROM utilisateurs WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Utilisateur supprimé avec succès']);
    } else {
        echo json_encode(['error' => 'Erreur lors de la suppression de l\'utilisateur']);
    }
}

$mysqli->close();
?>
