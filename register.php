<?php
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
require "./configs/conexao.php";

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['newEmail']) && isset($_POST['newName']) && isset($_POST['newLogin']) && isset($_POST['newPassword'])) {

	$newEmail = trim($_POST['newEmail']);
	$newName = trim($_POST['newName']);
	$newLogin = trim($_POST['newLogin']);
	$newPassword = hash('md5', trim($_POST['newPassword']));

	// verificando se usuario existe
	$usuario_existe = pg_query($bdOpen, "SELECT email FROM usuarios WHERE email='$newEmail'");
	// check for empty result
	if (pg_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	} else {
		// mysql inserting a new row
		$result = pg_query($bdOpen, "INSERT INTO usuarios(nome, nome_de_usuario, senha, email) VALUES('$newName', '$newLogin', '$newPassword', '$newEmail')");

		if ($result) {
			$response["success"] = 1;
		} else {
			$response["success"] = 0;
			$response["error"] = "Error BD: " . pg_last_error($bdOpen);
		}
	}
} else {
	$response["success"] = 0;
	$response["error"] = "faltam parametros";
}

pg_close($bdOpen);
echo json_encode($response);
