
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

// edição perfil
$imgPfp = NULL; // imagem atual 
$editName = NULL;
$editEmail = NULL;
$editBio = NULL;
$imgEditPhoto = NULL; // imagem de upload
$btnEditSave = NULL;

$result = pg_query($bdOpen, "UPDATE perfil() VALUES()");




//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}


// upload de imagem codigo
/* if (isset($_FILES['imgEditPhoto'])) {
    $msg = false;

    $arquivo = strtolower(substr($_FILES['imgEditPhoto']['name'], -4));
    $newarquivo = md5(time()) . $arquivo;
    $dir = "uploads/";

    move_uploaded_file($_FILES['imgEditPhoto']['tmp_name'], $dir . $newarquivo);

    $sql = "INSERT INTO usuarios(id_usuario, pfp) VALUES(null, '$newarquivo');";
    if (mysqli_query($dbOpen, $sql)) {
        $msg = "Arquivo enviado com sucesso!!";
    } else {
        $msg = "Falha ao enviar arquivo.";
    }

    //erro
    if ($msg != false) {
        echo "<p>$msg</p>";
    }
} */

pg_close($bdOpen);
echo json_encode($response);
?>
