
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();
//if isset

//session de usuario
$login = trim($_GET['login']);
$result = pg_query($bdOpen, "SELECT * FROM usuario WHERE email='$login'");

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_array($result);

    $response['name'] = $row['nome'];
    $response['userName'] = $row['nome_de_usuario'];
    $response['bio'] = $row['bio'];
    $response['img']=$row['pfp'];

    $response["success"] = 1;
}else {
    $response["success"] = 0;
    $response["message"] = "Nao ha dados";
}
pg_close($bdOpen);
echo json_encode($response);
?>
