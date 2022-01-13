<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$titulo = NULL;
$descricao = NULL;
$fk_usuarios_id_usuario = NULL;

//check for required fields
$titulo = trim($_POST['titulo']);
$descricao = trim($_POST['descricao']);
$fk_usuarios_id_usuario = trim($_POST['fk_usuarios_id_usuario']);


// insert temas 
// chamar o id do usuario 

/* $result = pg_query($bdOpen, "INSERT INTO tema(fk_usuarios_id_usuario) 
SELECT tema.fk_usuarios_id_usuario 
FROM usuarios INNER JOIN tema 
ON tema.fk_usuarios_id_usuario = usuarios.id_usuario;");
*/

/* INSERT INTO public.tema(titulo, descricao, fk_usuarios_id_usuario) 
VALUES('um titulo bem legal', 'esse e um treinamento muito certo', 10000); */

$result = pg_query($bdOpen, "INSERT INTO public.tema(titulo, descricao, fk_usuarios_id_usuario) VALUES('$titulo','$descricao', '{$fk_usuarios_id_usuario}');");

//falta adicionar o id do usuario na tabela de temas


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}


pg_close($bdOpen);
echo json_encode($response);
