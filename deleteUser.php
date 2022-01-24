<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

if (isset($_POST['login'])) {

    //session de usuario
    $login = trim($_POST['login']);

    $query = pg_query($bdOpen, "SELECT id_usuario FROM usuario WHERE email='$login'");
    $row = pg_fetch_array($query);
    $id_usuario = $row[0];

    $query = pg_query($bdOpen, "SELECT * FROM resposta WHERE fk_usuario_id_usuario = $id_usuario");
    $row = pg_fetch_array($query);
    if ($row) {
        pg_query($bdOpen, "DELETE FROM resposta WHERE fk_usuario_id_usuario = $id_usuario");
    }

    $query = pg_query($bdOpen, "SELECT * FROM comentario WHERE fk_usuario_id_usuario = $id_usuario");
    $row = pg_fetch_array($query);
    if ($row) {
        pg_query($bdOpen, "DELETE FROM comentario WHERE fk_usuario_id_usuario = $id_usuario");
    }

    $query = pg_query($bdOpen, "SELECT * FROM curtida WHERE fk_usuario_id_usuario = $id_usuario");
    $row = pg_fetch_array($query);
    if ($row) {
        pg_query($bdOpen, "DELETE FROM curtida WHERE fk_usuario_id_usuario = $id_usuario");
    }

    $query = pg_query($bdOpen, "SELECT * FROM tema WHERE fk_usuario_id_usuario = $id_usuario");
    $row = pg_fetch_array($query);
    if ($row) {
        $id_tema = $row['id_tema'];
        pg_query($bdOpen, "DELETE FROM debate WHERE fk_tema_id_tema = $id_tema");
        pg_query($bdOpen, "DELETE FROM tema WHERE fk_usuario_id_usuario = $id_usuario");
    }

    $result = pg_query($bdOpen, "DELETE FROM usuario WHERE id_usuario = $id_usuario");

    //check erro
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Usuario deletado com sucesso";
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);
    }
    pg_close($bdOpen);
    echo json_encode($response);
} else {
    
    $response["success"] = 0;
    $response["message"] = "Usuario nao foi deletado";

    
    pg_close($bdOpen);
    echo json_encode($response);
}
?>