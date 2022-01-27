<?php 

require "./configs/conexao.php";

// array for JSON response
$response = array();

$like = NULL;


/* 
quando o usuário clicar no botão de curtida, é preciso verificar qual o estado do botão e mudar ele
    caso não foi curtido, fazer um insert em curtida e mudar o botão para 'curtido'
    caso já foi curtido, fazer um delete e mudar o botão para 'não curtido'
provavelmente são feitos bastante pelo AndroidStudio, mas vou fazer a lógica aqui 
*/


if (isset($_POST['login'])){

    // verificar se tem algum registro de usuario e do tema na tabela curtida
    $login = trim($_POST['login']);
    $id_tema = trim($_POST['id_tema']);

    $query = pg_query($bdOpen, "SELECT id_usuario from usuario where email='$login'");
    $row = pg_fetch_array($query);
    $id_usuario = $row['id_usuario'];



    $sql = "SELECT (fk_usuario_id_usuario, fk_tema_id_tema)
    FROM curtida 
    WHERE fk_usuario_id_usuario = '$id_usuario' 
    AND fk_tema_id_tema = '$id_tema';";
    $result = pg_query($bdOpen, $sql);

    if (pg_num_rows($sql)>0) {
        $result = pg_query($bdOpen, "DELETE FROM curtida WHERE fk_usuario_id_usuario = '$id_usuario' AND FK_TEMA_id_tema = '$id_tema'");
        
        // mudar o botão para 'não curtido'

    } else {
        // pegar o id de usuario e o de debate
        $result = pg_query($bdOpen, "INSERT INTO curtida(fk_usuario_id_usuario, fk_tema_id_tema) VALUES ('$id_usuario', '$id_tema')");

        // mudar o botão para 'curtido'
    } 

    //check erro
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Curtida alterada com sucesso";

    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);
    }
    pg_close($bdOpen);
    echo json_encode($response);
}else{
    pg_close($bdOpen);
    echo json_encode($response);
}
?>