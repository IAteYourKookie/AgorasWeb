
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

//session de usuario
$login = trim($_POST['login']);
$query = pg_query($bdOpen, "SELECT * FROM usuario WHERE email='$login')");
$result = pg_fetch_array($query);

$nome = $result['nome'];
$usuario = $result['nome_de_usuario'];
$email = $result['email'];
$bio = $result['bio']; 
$imgPfp = $result['pfp']; // imagem atual 

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
