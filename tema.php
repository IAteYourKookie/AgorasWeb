<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

if (isset($_GET['login']) && isset($_POST['titulo']) && isset($_POST['descricao'])) {

    //check for required fields
    $login = trim($_GET['login']);
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    $result = pg_query($bdOpen, "INSERT INTO public.tema(titulo, descricao, fk_usuario_id_usuario) VALUES('$titulo','$descricao', (SELECT id_usuario from usuario where email='$login'));");

    //check erro
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Campo tema cadastrado com sucesso";
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);
    }

    pg_close($bdOpen);
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Campo tema nao cadastrado";

    pg_close($bdOpen);
    echo json_encode($response);
}
?>