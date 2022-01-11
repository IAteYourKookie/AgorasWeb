
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

pg_close($bdOpen);
echo json_encode($response);
?>