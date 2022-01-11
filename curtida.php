<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

/* 
 * Adicionar código para curtida
*/

$like = NULL;

// verificar se tem algum registro de usuario e do tema na tabela curtida

$sql = "SELECT FK_USUARIOS_id_usuario, FK_TEMA_id_tema 
FROM curtida 
WHERE FK_USUARIOS_id_usuario = '$id_usuario' 
AND FK_TEMA_id_tema = '$id_tema';";
$result = pg_query($bdOpen, $sql);

if (pg_fetch_array($sql)) {
    $del = "DELETE FROM curtida WHERE FK_USUARIOS_id_usuario = '$id_usuario' AND FK_TEMA_id_tema = '$id_tema'";
} else {
    /*   
 Fazer insert com 2 tabelas diferentes 

 $insert = "INSERT INTO curtida() VALUES ()"; 
*/
}


pg_close($bdOpen);
echo json_encode($response);
