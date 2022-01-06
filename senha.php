<?php
require "conexao.php";

// array for JSON response
$response = array();


pg_close($bdOpen);
echo json_encode($response);
