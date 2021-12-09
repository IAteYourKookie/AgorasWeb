<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */


extension_loaded('pgsql') ? 'yes' : 'no';

$bdOpen = pg_connect(getenv("DATABASE_URL"))
	or die("Não foi possível conectar ao servidor");

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['newEmail']) && isset($_POST['newSenha'])) {

	$newEmail = trim($_POST['newEmail']);
	$newSenha = trim($_POST['newSenha']);
	//$newNome = trim($_POST['newNome']);
	$newnome_de_usuario = trim($_POST['newnome_de_usuario']);

	// verificando se usuario existe
	$usuario_existe = pg_query($bdOpen, "SELECT email FROM usuarios WHERE email='$newEmail'");
	// check for empty result
	if (pg_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	} else {
		// mysql inserting a new row
		$result = pg_query($bdOpen, "INSERT INTO usuarios(nome, nome_de_usuario, senha, email) VALUES(NULL, '$newnome_de_usuario', '$newSenha', '$newEmail')");

		if ($result) {
			$response["success"] = 1;
		} else {
			$response["success"] = 0;
			$response["error"] = "Error BD: " . pg_last_error($bdOpen);
		}
	} /* 
	codigo de verificação de senha (fazer alteração)
	if($_POST) {
        $senha          = $_POST['senha'];
        $senhaConfirma  = $_POST['senha_confirma'];
        if ($senha == "") {
            $mensagem = "<span class='aviso'><b>Aviso</b>: Senha não foi alterada!</span>";
        } else if ($senha == $senhaConfirma) {
            $mensagem = "<span class='sucesso'><b>Sucesso</b>: As senhas são iguais: ".$senha."</span>";
        } else {
            $mensagem = "<span class='erro'><b>Erro</b>: As senhas não conferem!</span>";
        }
        echo "<p id='mensagem'>".$mensagem."</p>";
    } 
	*/
} else {
	$response["success"] = 0;
	$response["error"] = "faltam parametros";
}

pg_close($bdOpen);
echo json_encode($response);
