<?php

include "./mysql.php";
function getEntity($entity){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM $entity");
    $rows = [];
    
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    echo json_encode($rows);
}

// Route pour créer un nouvel utilisateur (Create - POST)
function postEntity($entity){
    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $data['nom'];
    $email = $data['email'];

    $stmt = $mysqli->prepare("INSERT INTO ? (nom, email) VALUES (?, ?)");
    $stmt->bind_param("sss", $entity, $nom, $email);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Utilisateur créé avec succès']);
    } else {
        echo json_encode(['error' => 'Erreur lors de la création de l\'utilisateur']);
    }
}
/*
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
*/