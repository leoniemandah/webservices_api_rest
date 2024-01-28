<?php

include "./mysql.php";
function getEntity($entity){
    global $mysqli, $ENTITES;
    
    if (in_array($entity, $ENTITES)){
        $result = $mysqli->query("SELECT * FROM $entity");
        $rows = [];
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        echo json_encode($rows);
        exit(0);
    } 
    echo json_encode(['error' => "Erreur lors de la consultation de l'entité $entity"]);
}

// Route pour créer un nouvel utilisateur (Create - POST)
function postEntity($entity){
    global $mysqli, $ENTITES;
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity, $ENTITES)){
        $sql = "INSERT INTO $entity";
        
        switch($entity){
            case "user": 
                $sql .= " (nom) VALUES (?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("s", $nom);
                break;
            case "livres" : 
                $sql .= " (titre, auteur) VALUES (?, ?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ss", $titre, $auteur);
                break;
        }
    

        if ($stmt->execute()) {
            echo json_encode(['message' => "L'entité $entity créé avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la création de l'entité $entity"]);
    
}

// Route pour mettre à jour un utilisateur (Update - PUT)
function putEntity($entity){
    global $mysqli, $ENTITES;
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity, $ENTITES)){
        $sql = "UPDATE $entity SET ";
        
        switch($entity){
            case "user": 
                $sql .= " nom=? WHERE id=?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("si", $nom, $id);
                break;
            case "livres" : 
                $sql .= " titre=?, auteur=? WHERE id=?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssi", $titre, $auteur, $id);
                break;
        }
    

        if ($stmt->execute()) {
            echo json_encode(['message' => "L'entité $entity modifié avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la modification de l'entité $entity"]);
    
}


// Route pour supprimer un utilisateur (Delete - DELETE)
function deleteEntity($entity){
    global $mysqli, $ENTITES;
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity, $ENTITES)){
        $sql = "UPDATE $entity SET ";
        
        switch($entity){
            case "user": 
            case "livres" : 
                $stmt = $mysqli->prepare("DELETE FROM $entity WHERE id=?");
                $stmt->bind_param("i", $id);
                break;
        }
    

        if ($stmt->execute()) {
            echo json_encode(['message' => "L'entité $entity supprimé avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la suppression de l'entité $entity"]);
    
}
