
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

// $currentPassword = NULL; senha atual
$newPassword = NULL; //redefinir senha
$passwordCheck = NULL; //verificar senha 

//session de usuario
$login = trim($_POST['login']);

$newPassword = trim($_POST['editPassword']);
$passwordCheck = trim($_POST['passwordCheck']);
   
$result = pg_query($bdOpen, "UPDATE usuario SET senha='$newPassword' WHERE id_usuario=(SELECT id_usuario from usuario where email='$login')");

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
