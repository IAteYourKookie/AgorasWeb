
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

// redefinir senha
$oldPass = NULL;
$newPass = NULL;
$passCheck = NULL;

// edição perfil
$imgPfp = NULL;
$editName = NULL;
$editEmail = NULL;
$editBio = NULL;

$result = pg_query($bdOpen, "INSERT INTO perfil() VALUES()");


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