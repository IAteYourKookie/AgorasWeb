<?php
require "conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para debate
 * CRUD -> insert, select, delete
*/

pg_close($bdOpen);
echo json_encode($response);
?>