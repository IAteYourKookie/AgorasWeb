<?php
require "conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para tema
 * CRUD -> insert, select
*/

$titulo = NULL;
$desc = NULL;


pg_close($bdOpen);
echo json_encode($response);
?>