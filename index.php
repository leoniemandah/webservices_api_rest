<?php
include "./fonctions.php";


// Route pour récupérer tous les utilisateurs (Read - GET)
switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': 
        call_user_func("getEntity");
        break;
    case 'POST':
        call_user_func("postEntity");
        break;
    case 'PUT':
        call_user_func("putEntity");
        break;
    case 'DELETE':
        call_user_func("deleteEntity");
        break;
    default:
        http_response_code(405);
        exit(0);
}

$mysqli->close();
?>
