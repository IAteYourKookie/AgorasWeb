
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

//session de usuario
$login = trim($_POST['login']);
$query = pg_query($bdOpen, "SELECT * FROM usuario WHERE email='$login')");
$result = pg_fetch_array($query);

$response["usuario"] = array();
while ($row = pg_fetch_array($result)) {
    $usuario = array();
    $usuario['naome'] = $row['nome'];
    $usuario['userName'] = $row['nome_de_usuario'];
    $usuario['bio'] = $row['bio'];
    $usuario['img']=$row['pfp'];
}

$response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}
pg_close($bdOpen);
echo json_encode($response);
?>
