<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$resposta = NULL;

//alterar para resposta
$resposta = trim($_POST['resposta']);
//$login = trim($_GET['login]);


/* $result = pg_query($bdOpen, "INSERT INTO resposta(
    fk_comentario_id_comentario, fk_usuarios_id_usuario
    ) SELECT resposta.fk_resposta_id_resposta, usuarios.fk_usuarios_usuario
    FROM resposta, usuarios INNER JOIN resposta 
    ON resposta.fk_resposta_id_resposta = resposta.id_resposta AND
    resposta.fk_usuarios_id_usuario = usuarios.id_usuario 
"); */

//id => (SELECT id_usuario from usuario where email='$login');
$result = pg_query($bdOpen, "INSERT INTO resposta(data_envio, resposta) VALUES(NOW(), '$resposta')");

// adicionar select 
//falta adicionar as chaves estrangeiras 


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
