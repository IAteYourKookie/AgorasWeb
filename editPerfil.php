
<?php
require "./configs/conexao.php";


// edição perfil
$imgPfp = NULL; // imagem atual 
$imgEditPhoto = NULL; // imagem de upload


//session de usuario
$login = trim($_POST['login']); //email
$newName = trim($_POST['editName']);//Nome
$newUser = trim($_POST['editUser']);//Nome de usuario
$newEmail = trim($_POST['editEmail']);//novo email
$newBio = trim($_POST['editBio']);//bio

//id => (SELECT id_usuario from usuario where email='$login');
$result = pg_query($bdOpen, "UPDATE usuario SET nome='$newName', nome_de_usuario='$newUser', email ='$newEmail', bio ='$newBio' WHERE id_usuario=(SELECT id_usuario from usuario where email='$login')");

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
