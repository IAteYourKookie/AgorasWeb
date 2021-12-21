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
if (isset($_POST['titulo']) && isset($_POST['descricao'])) {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    // insert temas 
    $result = pg_query($bdOpen, "INSERT INTO tema(titulo, descricao, FK_USUARIOS_id_usuario) 
    SELECT tema.titulo, tema.descricao tema.FK_USUARIOS_id_usuario 
    FROM usuarios INNER JOIN tema 
    ON tema.FK_USUARIOS_id_usuarios = usuarios.FK_USUARIOS_id_usuarios");

    //check erro
    if ($result) {
        $response["success"] = 1;
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);
    }
} else {
    $response["success"] = 0;
    $response["error"] = "campo em branco";
}

pg_close($bdOpen);
echo json_encode($response);
