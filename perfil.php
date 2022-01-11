
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

pg_close($bdOpen);
echo json_encode($response);
?>