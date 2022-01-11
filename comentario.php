<?php
require "conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para comentario 
 * CRUD -> insert, select, delete
*/

$comentario = NULL;

//check for required fields
$comentario = trim($_POST['comentario']);

$result = pg_query($bdOpen, "INSERT INTO comentario(data_envio, comentario) VALUES(NOW(), '$comentario')");
//falta adicionar as chaves estrangeiras, like e deslike

//adicionar o select 


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
?>