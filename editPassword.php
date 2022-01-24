<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

if (isset($_POST['login']) && isset($_POST['newPass'])) {

    //session de usuario
    $login = trim($_POST['login']);
    $newPassword = trim($_POST['newPass']);

    $result = pg_query($bdOpen, "UPDATE usuario SET senha='$newPassword' WHERE id_usuario=(SELECT id_usuario from usuario where email='$login'");

    //check erro
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Senha editada com sucesso";
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);
    }

    pg_close($bdOpen);
    echo json_encode($response);
} else {

    $response["success"] = 0;
    $response["message"] = "Senha não editada";


    pg_close($bdOpen);
    echo json_encode($response);
}
?>