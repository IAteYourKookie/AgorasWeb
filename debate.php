<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

/* 
 * CRUD -> insert, select
 * OldDebate -> insert, select 
*/


$tvTitleTheme = NULL;
$tvDescDebate = NULL;
$tvDebates = NULL;
$tvOldDebates = NULL;
$dataAtual = NULL;


//check for required fields
$tvDescDebate = trim($_POST['tvDescDebate']);

$result = pg_query($bdOpen, "INSERT INTO debate(dt_inicio, dt_final) VALUES(NOW(), '$dt_final')");


/* 
Fazer chave estrangeira entre fk_tema_id_tema e debate, para 
referenciar qual debate está sendo executado.
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
