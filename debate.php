<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$tvTitleTheme = NULL;
$tvDescDebate = NULL;
$tvDebates = NULL;

//check for required fields
$tvDescDebate = trim($_POST['tvDescDebate']);
$tvTitleTheme = trim($_POST['tvDescDebate']);

/* 
$result = pg_query($bdOpen, ""); 
*/

$dataAtual = date("Y-m-d");
$result = pg_query($bdOpen, "SELECT * FROM debate WHERE (dt_final > '$dataAtual')");


//se retornar alguma linha, tem debate em andamento
if (pg_num_rows($result) > 0) {
    //carregar o debate mais atual
    $row = pg_fetch_array($result);
    $id_tema = $row[3];

    $result = pg_query($bdOpen, "SELECT * FROM tema WHERE (id_tema = $id_tema)");
    $row = pg_fetch_array($result);
    $tvTitleTheme = $row[1];
    $tvDescDebate = $row[2];
    echo $tvTitleTheme;
    echo $tvDescDebate;
} else {
    //carregar um tema novo pro debate
    //usar select count()
    

}


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
