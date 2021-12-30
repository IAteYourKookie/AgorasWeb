<?php
require "conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para tema
 * CRUD -> insert, select
*/

$titulo = NULL;
$descricao = NULL;

//check for required fields

$titulo = trim($_POST['titulo']);
$descricao = trim($_POST['descricao']);

// insert temas 
$result = pg_query($bdOpen, "INSERT INTO tema(fk_usuarios_id_usuario) 
SELECT tema.fk_usuarios_id_usuario 
FROM usuarios INNER JOIN tema 
ON tema.fk_usuarios_id_usuario = usuarios.id_usuario;");
$result= pg_query($bdOpen,"INSERT INTO tema(titulo,descricao) VALUES('$titulo','$descricao')");


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}


pg_close($bdOpen);
echo json_encode($response);
