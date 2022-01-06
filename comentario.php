<?php
require "conexao.php";
require "checkData.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para comentario 
 * CRUD -> insert, select, delete
*/

$comentario = NULL;
$etMessage = NULL; //var do comentario no android studio 

//check for required fields
$comentario = trim($_POST['comentario']);
$data = date($_POST['data']);

$result = pg_query($bdOpen, "INSERT INTO comentario(
    fk_debate_id_debate, fk_usuarios_id_usuario
    ) SELECT debate.fk_debate_id_debate, usuarios.fk_usuarios_usuario
    FROM debate, usuarios INNER JOIN comentario 
    ON comentario.fk_debate_id_debate = debate.id_debate AND
    comentario.fk_usuarios_id_usuario = usuarios.id_usuario 
");
$result = pg_query($bdOpen, "INSERT INTO comentario(data, comentario) VALUES('$data', '$comentario')");

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
