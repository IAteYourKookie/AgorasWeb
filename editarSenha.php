
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

// redefinir senha
$oldPass = NULL;
$newPass = NULL;
$passCheck = NULL;

// senha antiga
$etOldPassword = NULL;
$etOldPassword = NULL;

//SENHA NOVA 
$etSaveNewPassaword = NULL;
$btnSave = NULL;


//session de usuario
$login = trim($_POST['login']);
$newName = trim($_POST['editName']);
$newUser = trim($_POST['editUser']);
$newEmail = trim($_POST['editEmail']);
$newBio = trim($_POST['editBio']); 


//id => (SELECT id_usuario from usuario where email='$login');
$result = pg_query($bdOpen, "UPDATE perfil() VALUES()");


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
