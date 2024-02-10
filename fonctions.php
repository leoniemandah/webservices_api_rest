<?php

include "./mysql.php";
require_once "./utilities.php";

function getEntity(){
    global $mysqli, $ENTITES, $entity1, $entity2, $url;
    $sql = "SELECT * FROM $entity1";
    //echo json_encode($url);
    
    switch (sizeof($url)){
        case 2:
            if ($url[1]==""){
                include("./documentation.php");
                exit(0);
            }
            break;
        case 3:
            $sql .= entity_1_id();
            break;
        case 4:
            $sql .= join_2_entities(); 
            $sql .= entity_1_id();
            break;
        case 5:
            $sql .= join_2_entities(); 
            $sql .= entity_1_id();
            $sql .= entity_2_id();
            break;
        default:
            do_exit();
    }
header('Content-Type: application/json; charset=UTF-8');

    if (in_array($entity1, $ENTITES)){
        $result = $mysqli->query($sql);
        $rows = [];
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        http_response_code(200);
        echo json_encode($rows);
        exit(0);
    } 
    echo json_encode(['error' => "Erreur lors de la consultation de l'entité $entity1"]);
}

// Route pour créer un nouvel utilisateur (Create - POST)
function postEntity(){
    global $mysqli, $ENTITES, $entity1, $url;
    
    verify_url_length(2);

    header('Content-Type: application/json; charset=UTF-8');
    
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity1, $ENTITES)){
        $sql = "INSERT INTO $entity1";
        
        switch($entity1){
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
            http_response_code(201);
            echo json_encode(['message' => "L'entité $entity1 créé avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la création de l'entité $entity1"]);
    
}

// Route pour mettre à jour un utilisateur (Update - PUT)
function putEntity(){
    global $mysqli, $ENTITES, $entity1, $url;
    
    verify_url_length(3);

    header('Content-Type: application/json; charset=UTF-8');
    
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity1, $ENTITES)){
        $sql = "UPDATE $entity1 SET ";
        
        switch($entity1){
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
            echo json_encode(['message' => "L'entité $entity1 modifié avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la modification de l'entité $entity1"]);
    
}


// Route pour supprimer un utilisateur (Delete - DELETE)
function deleteEntity(){
    global $mysqli, $ENTITES, $entity1, $url;
    verify_url_length(3);
    header('Content-Type: application/json; charset=UTF-8');
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    if (in_array($entity1, $ENTITES)){
        $sql = "UPDATE $entity1 SET ";
        
        switch($entity1){
            case "user": 
            case "livres" : 
                $stmt = $mysqli->prepare("DELETE FROM $entity1 WHERE id=?");
                $stmt->bind_param("i", $id);
                break;
        }
    

        if ($stmt->execute()) {
            echo json_encode(['message' => "L'entité $entity1 supprimé avec succès"]);
            exit(0);
        }
    } 
    echo json_encode(['error' => "Erreur lors de la suppression de l'entité $entity1"]);
    
}

