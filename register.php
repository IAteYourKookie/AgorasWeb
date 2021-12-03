<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 

// conecta ao BD
$db_name = 'agoras';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'cacau123';

extension_loaded('pgsql') ? 'yes' : 'no';

$bdOpen = pg_connect("postgres://postgres:cacau123@localhost:5432/postgres")
	or die("Não foi possível conectar ao servidor MySQL");
//caso a conexão seja efetuada com sucesso, exibe uma mensagem ao usuário
echo "Conexão efetuada com sucesso!!";

 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['newLogin']) && isset($_POST['newPassword'])) {
 
	$newLogin = trim($_POST['newLogin']);
	$newPassword = trim($_POST['newPassword']);
		
	$usuario_existe = pg_query($bdOpen, "SELECT login FROM usuarios WHERE login='$newLogin'");
	// check for empty result
	if (pg_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	}
	else {
		// mysql inserting a new row
		$result = pg_query($bdOpen, "INSERT INTO usuarios(login, senha) VALUES('$newLogin', '$newPassword')");
	 
		if ($result) {
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["error"] = "Error BD: ".pg_last_error($bdOpen);
		}
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}

pg_close($bdOpen);
echo json_encode($response);
?>