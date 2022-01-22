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
$result = pg_query($bdOpen, "SELECT * FROM curtida");
 

if (pg_num_rows($result) > 0) {
    // Caso existam produtos no BD, eles sao armazenados na 
	// chave "products". O valor dessa chave e formado por um 
	// array onde cada elemento e um produto.
    $response["id_curtida"] = array(); 
 
    while ($row = pg_fetch_array($result)) {
        $curtida = array();
        $curtida["id_curtida"] = $row["id_curtida"];
        /* $curtida[""] = $row[""]; */
 
        // Adiciona o produto no array de produtos.
        array_push($response["id_curtida"], $curtida); 
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
    $response["message"] = "Nao ha curtidas";
	
	// Fecha a conexao com o BD
	pg_close($bdOpen);
 
    // Converte a resposta para o formato JSON.
    echo json_encode($response);
}
?>