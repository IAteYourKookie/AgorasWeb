
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

//session de usuario
$login = trim($_POST['login']);
$query = pg_query($bdOpen, "SELECT id_usuario FROM usuario WHERE email='$login')");
$result = pg_fetch_array($query);
$id_usuario = $result['id_usuario'];

$

$nome = "";
$usuario = "";
$email = "";
$bio = ""; 
$imgPfp = NULL; // imagem atual 

//id => (SELECT id_usuario from usuario where email='$login');

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
