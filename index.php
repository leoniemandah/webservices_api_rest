<?php
include "./fonctions.php";
header('Content-Type: application/json; charset=UTF-8');

$url = explode('/', $_SERVER[ 'REQUEST_URI' ]);
$entity = $url [1];
// Route pour récupérer tous les utilisateurs (Read - GET)
switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': 
        call_user_func("getEntity",$entity);
        break;
    case 'POST':
        call_user_func("postEntity",$entity);
        break;
    case 'PUT':
        call_user_func("putEntity",$entity);
        break;
    case 'DELETE':
        call_user_func("deleteEntity",$entity);
        break;
    default:
    echo json_encode(['message' => "Méthode non implémenté !"]);
            exit(0);
}

$mysqli->close();
?>
