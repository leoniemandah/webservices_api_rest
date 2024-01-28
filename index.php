<?php
include "./fonctions.php";
header('Content-Type: application/json');

$url = explode('/', $_SERVER[ 'REQUEST_URI' ]);
$entity = $url [1];
// Route pour récupérer tous les utilisateurs (Read - GET)
switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': call_user_func("getEntity",$entity);
        break;
    default:
    
}

$mysqli->close();
?>
