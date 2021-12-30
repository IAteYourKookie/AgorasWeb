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

pg_close($bdOpen);
echo json_encode($response);
