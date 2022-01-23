<?php

// array for JSON response
$response = array();

require "./configs/conexao.php";

$nome = NULL;
$senha = NULL;

$isAuth = false;

// Método para mod_php (Apache)
if (isset($_SERVER['PHP_AUTH_USER'])) {
	$nome = $_SERVER['PHP_AUTH_USER'];
	$senha = $_SERVER['PHP_AUTH_PW'];
} // Método para demais servers
elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
	if (preg_match('/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($nome, $senha) = explode(':', base64_decode(
			substr($_SERVER['HTTP_AUTHORIZATION'], 6)
		));
}

// Se a autenticação não foi enviada
if (!is_null($nome)) {
	$query = pg_query($bdOpen, "SELECT senha FROM usuarios WHERE login='$nome'");

	if (pg_num_rows($query) > 0) {
		$row = pg_fetch_array($query);
		if (hash('md5', $senha) == $row['senha']) {
			$isAuth = true;
		}
	}
}

if ($isAuth) {
	$response["success"] = 1;

	// codigo sql da sua consulta
	$response["data"] = "Dados da app";
} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}

pg_close($bdOpen);
echo json_encode($response);
?>