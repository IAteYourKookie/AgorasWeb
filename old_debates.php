<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$tvOldDebates = NULL;

//check for required fields
$tvOldDebates = trim($_POST['tvOldDebates']);

$result = pg_query($bdOpen, "INSERT INTO debate() VALUES(NOW())");


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}



pg_close($bdOpen);
echo json_encode($response);
