<?php
extension_loaded('pgsql') ? 'yes' : 'no';

$bdOpen = pg_connect(getenv("DATABASE_URL"))
	or die("Não foi possível conectar ao servidor");

// array for JSON response
$response = array();

$nome = NULL;
$senha = NULL;

// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $nome = $_SERVER['PHP_AUTH_USER'];
    $senha = $_SERVER['PHP_AUTH_PW'];
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($nome, $senha) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if(is_null($nome)) {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}
// Se houve envio dos dados
else {
    $query = pg_query($bdOpen, "SELECT senha FROM usuarios WHERE email='$nome'");

	if(pg_num_rows($query) > 0){
		$row = pg_fetch_array($query);
		if($senha == $row['senha']){
			$response["success"] = 1;
		}
		else {
			// senha ou usuario nao confere
			$response["success"] = 0;
			$response["error"] = "usuario ou senha não confere";
		}
	}
	else {
		// senha ou usuario nao confere
		$response["success"] = 0;
		$response["error"] = "usuario ou senha não confere";
	}
}

pg_close($bdOpen);
echo json_encode($response);
?>