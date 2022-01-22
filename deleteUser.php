
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

//session de usuario
$login = trim($_POST['login']);

// deletar antes: tema, curtida, comentario, resposta
$query = pg_query($bdOpen, "SELECT id_usuario FROM usuario WHERE email='$login')");
$row = pg_fetch_array($query);
$id_usuario = $row['id_usuario'];

$query = pg_query($bdOpen, "SELECT * FROM tema WHERE fk_usuario_id_usuario = '$id_usuario'");



//$result = pg_query($bdOpen, "DELETE usuario WHERE id_usuario=(SELECT id_usuario from usuario where email='$login')");

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
