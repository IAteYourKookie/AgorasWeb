<?php

// array for JSON response
$response = array();

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
		if ($senha == $row['senha']) {
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
