<?php
require "./configs/conexao.php";

/*
 * O seguinte codigo retorna para o cliente a lista de comentarios 
 * armazenados no servidor. Essa e uma requisicao do tipo POST. 
 * Nao sao necessarios nenhum tipo de parametro.
 * A resposta e no formato JSON.
 */


// array que guarda a resposta da requisicao
$response = array();

$comentario["idTema"] = $row["fk_tema_id_tema"];

// Realiza uma consulta ao BD e obtem todos os produtos.
$result = pg_query($bdOpen, "SELECT * FROM comentario WHERE fk_tema_id_tema = $idTema;");


if (pg_num_rows($result) > 0) {
    // Caso existam comentarios no BD, eles sao armazenados na 
    // chave "comentario". O valor dessa chave e formado por um 
    // array onde cada elemento e um comentario.
    $response["comentario"] = array();

    while ($row = pg_fetch_array($result)) {
        // Para cada comentario, sao retornados somente o 
        // id_comentario e o proprio comentario. Nao ha necessidade 
        // de retornar nesse momento todos os campos de todos os comentarios 
        // pois a app cliente, inicialmente, so precisa do nome do mesmo para 
        // exibir na lista de comentarios. O campo id_comentario e usado pela app cliente 
        // para buscar os detalhes de um comentario especifico quando e seleciona
        // no BD. 
        $comentario = array();
        $comentario["id_comentario"] = $row["id_comentario"];
        $comentario["comentario"] = $row["comentario"];
        $comentario["idUsuario"] = $row["fk_usuario_id_usuario"];
        $idUser = (int)$comentario["idUsuario"];
        $query = pg_query($bdOpen, "SELECT nome FROM usuario WHERE id_usuario='$idUser'");
        $row = pg_fetch_array($query);
        $row = $row['nome'];
        $comentario["nomePerfil"] = $row;

        //imagem de perfil 
        $query = pg_query($bdOpen, "SELECT pfp FROM usuario WHERE id_usuario='$idUser'");
        $row = pg_fetch_array($query);
        $row = $row['pfp'];
        $comentario["img"] = $row;

        //nome de usuario
        $query = pg_query($bdOpen, "SELECT nome_de_usuario FROM usuario WHERE id_usuario='$idUser'");
        $row = pg_fetch_array($query);
        $row = $row['nome_de_usuario'];
        $comentario["nomeUser"] = $row;

        // Adiciona o produto no array de produtos.
        array_push($response["comentario"], $comentario);
    }
    // Caso haja comentarios no BD, o cliente 
    // recebe a chave "success" com valor 1. A chave "message indica
    //que os comentarios foram carregados.
    $response["success"] = 1;

    // Fecha a conexao com o BD
    pg_close($bdOpen);

    // Converte a resposta para o formato JSON.
    echo json_encode($response);
} else {
    // Caso nao haja comentarios no BD, o cliente 
    // recebe a chave "success" com valor 0. A chave "message" indica o 
    // motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Nao ha comentarios";

    pg_close($bdOpen);
    echo json_encode($response);
}
?>