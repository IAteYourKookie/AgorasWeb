
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

//session de usuario
$login = trim($_POST['login']);
$query = pg_query($bdOpen, "SELECT * FROM usuario WHERE email='$login')");
$result = pg_fetch_array($query);

if (pg_num_rows($result) > 0) {
    $response["usuario"] = array();

    while ($row = pg_fetch_array($result)) {
        $usuario = array();
        
    }
    $response["success"] = 1;
}else {
    $response["success"] = 0;
    $response["message"] = "Nao ha dados";
}
pg_close($bdOpen);
echo json_encode($response);
?>
