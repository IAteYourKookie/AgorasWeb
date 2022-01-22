<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$comentario = NULL;

//check for required fields
$login = trim($_GET['login']);


$comentario = trim($_POST['comentario']);

$id=pg_query($bdOpen, "(SELECT id_usuario from usuario where email='$login')");
print_r($login);
echo "<br>";
print_r($id);
//$result = pg_query($bdOpen, "INSERT INTO comentario(data_envio, comentario, fk_usuario_id_usuario) VALUES(NOW(), '$comentario',$id);");

/*
$result = pg_query($bdOpen, "INSERT INTO comentario(data_envio, comentario, fk_usuario_id_usuario)
SELECT comentario.id_comentario, comentario.comentario, comentario.fk_usuario_id_usuario, 
FROM usuario INNER JOIN comentario ON comentario.id_comentario = usuario.fk_usuario_id_usuario
");
*/

//falta adicionar as chaves estrangeiras, like e deslike

//adicionar o select 
//$query = pg_query($bdOpen, "SELECT * FROM comentario");

//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}


pg_close($bdOpen);
echo json_encode($response);
