<?php
require "./configs/conexao.php";

/*
 * O seguinte codigo retorna para o cliente a lista de produtos 
 * armazenados no servidor. Essa e uma requisicao do tipo GET. 
 * Nao sao necessarios nenhum tipo de parametro.
 * A resposta e no formato JSON.
 */


// array que guarda a resposta da requisicao
$response = array();

// Realiza uma consulta ao BD e obtem todos os produtos.
$result = pg_query($bdOpen, "SELECT * FROM comentario");


if (pg_num_rows($result) > 0) {
    // Caso existam produtos no BD, eles sao armazenados na 
    // chave "products". O valor dessa chave e formado por um 
    // array onde cada elemento e um produto.
    $response["comentario"] = array();

    while ($row = pg_fetch_array($result)) {
        // Para cada produto, sao retornados somente o 
        // pid (id do produto) e o nome do produto. Nao ha necessidade 
        // de retornar nesse momento todos os campos de todos os produtos 
        // pois a app cliente, inicialmente, so precisa do nome do mesmo para 
        // exibir na lista de produtos. O campo pid e usado pela app cliente 
        // para buscar os detalhes de um produto especifico quando o usuario 
        // o seleciona. Esse tipo de estrategia poupa banda de rede, uma vez 
        // os detalhes de um produto somente serao transferidos ao cliente 
        // em caso de real interesse.
        $comentario = array();
        $comentario["id_comentario"] = $row["id_comentario"];
        $comentario["comentario"] = $row["comentario"];
        $comentario["idUsuario"] = $row["fk_usuario_id_usuario"];
        $idUser = (int)$comentario["idUsuario"];
        echo pg_query($bdOpen, "SELECT nome FROM usuario WHERE id_usuario=$idUser");
        echo "<br />";
        $comentario["nomePerfil"] = pg_query($bdOpen, "SELECT nome FROM usuario WHERE id_usuario=$idUser");
        //nome de usuario e img de perfil 

        // Adiciona o produto no array de produtos.
        array_push($response["comentario"], $comentario);
    }
    // Caso haja produtos no BD, o cliente 
    // recebe a chave "success" com valor 1.
    $response["success"] = 1;

    pg_close($bdOpen);

    // Converte a resposta para o formato JSON.
    echo json_encode($response);
} else {
    // Caso nao haja produtos no BD, o cliente 
    // recebe a chave "success" com valor 0. A chave "message" indica o 
    // motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Nao ha comentarios";

    // Fecha a conexao com o BD
    pg_close($bdOpen);

    // Converte a resposta para o formato JSON.
    echo json_encode($response);
}
