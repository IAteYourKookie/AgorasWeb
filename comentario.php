<?php
require "conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para comentario 
 * CRUD -> insert, select, delete
*/

pg_close($bdOpen);
echo json_encode($response);
