
<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

if (isset($_GET['login'])) {

    //session de usuario
    $login = trim($_GET['login']);
    $result = pg_query($bdOpen, "SELECT * FROM usuario WHERE email='$login'");

    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_array($result);

        $response['name'] = $row['nome'];
        $response['userName'] = $row['nome_de_usuario'];
        $response['bio'] = $row['bio'];
        $response['img'] = $row['pfp'];
        $response['dataIngresso'] = $row['data_ingresso'];

        $response["success"] = 1;
        $response["message"] = "Perfil foi carregado com sucesso";
    } else {
        $response["success"] = 0;
        $response["message"] = "Nao ha dados";
    }

    pg_close($bdOpen);
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Perfil nao foi carregado";

    pg_close($bdOpen);
    echo json_encode($response);
}
?>