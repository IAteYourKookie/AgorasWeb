
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

// edição perfil
$imgPfp = NULL; // imagem atual 
$imgEditPhoto = NULL; // imagem de upload

//session de usuario
$login = trim($_POST['login']);
$result = pg_fetch_array($query);
$id_usuario = $row['id_usuario'];

$nome = "";
$usuario = "";
$email = "";
$bio = ""; 


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
