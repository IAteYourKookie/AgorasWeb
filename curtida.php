<?php
// ☒ Adiado

require "./configs/conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para curtida
*/

$like = NULL;
// verificar se tem algum registro de usuario e do tema na tabela curtida

/* 
$sql = "SELECT (fk_usuarios_id_usuario, fk_tema_id_tema)
FROM curtida 
WHERE fk_usuarios_id_usuario = '$id_usuario' 
AND fk_tema_id_tema = '$id_tema';";
$result = pg_query($bdOpen, $sql);

if (pg_fetch_array($sql)) {
    $del = "DELETE FROM curtida WHERE FK_USUARIOS_id_usuario = '$id_usuario' AND FK_TEMA_id_tema = '$id_tema'";
} else { 
    Fazer insert com 2 tabelas diferentes 

    $insert = "INSERT INTO curtida() VALUES ()"; 
} 
*/

//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
