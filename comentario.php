<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$comentario = NULL;

if (isset($_GET['login']) && isset($_POST['comentario'])) {

    //check for required fields
    $login = trim($_GET['login']);
    $comentario = trim($_POST['comentario']);

    $result = pg_query($bdOpen, "INSERT INTO comentario(data_envio, comentario, fk_usuario_id_usuario) 
    VALUES(NOW(), '$comentario',(SELECT id_usuario from usuario where email='$login'));");

    //check erro
    if ($result) {
        // Se o comentario foi inserido corretamente no servidor, o cliente 
        // recebe a chave "success" com valor 1
        $response["success"] = 1;
        $response["message"] = "Comentario criado com sucesso";

        // Fecha a conexao com o BD
        pg_close($bdOpen);

        // Converte a resposta para o formato JSON.
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);

    
        pg_close($bdOpen);
        echo json_encode($response);
    }
} else {
    
    $response["success"] = 0;
    $response["message"] = "Campo comentario nao preenchido";

    
    pg_close($bdOpen);
    echo json_encode($response);
}
