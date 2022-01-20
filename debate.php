<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$tvTitleTheme = NULL;
$tvDescDebate = NULL;
$tvDebates = NULL;

//check for required fields
$tvDescDebate = trim($_POST['tvDescDebate']);

/* 
$result = pg_query($bdOpen, ""); */
$dataAtual = NULL;
$result = pg_query($bdOpen, "SELECT * FROM debate WHERE (dt_final > '$dataAtual')");




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
