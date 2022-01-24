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
$login = trim($_GET['login']);
$result = pg_query($bdOpen, "SELECT * FROM tema");
 
if (isset($_GET['login'])) {
    if (pg_num_rows($result) > 0) {
        // Caso existam produtos no BD, eles sao armazenados na 
        // chave "products". O valor dessa chave e formado por um 
        // array onde cada elemento e um produto.
        $response["tema"] = array(); 
    
        while ($row = pg_fetch_array($result)) {
            $tema = array();
            $tema["id_tema"] = $row["id_tema"];
            $tema["titulo"] = $row["titulo"];
            $tema["desc"] = $row["descricao"];
            $tema["id_usuario"] = $row["fk_usuario_id_usuario"];

            $query = pg_query($bdOpen, "SELECT nome FROM usuario WHERE id_usuario='$tema['id_usuario']'");
            $row = pg_fetch_array($query);
            $row = $row['nome'];
            $tema["nomeUsuario"] = $row;
    
            // Adiciona o produto no array de produtos.
            array_push($response["tema"], $tema); 
        }
        // Caso haja produtos no BD, o cliente 
        // recebe a chave "success" com valor 1.
        $response["success"] = 1;
        
    } else {
        // Caso nao haja produtos no BD, o cliente 
        // recebe a chave "success" com valor 0. A chave "message" indica o 
        // motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Nao ha temas";
    }
    pg_close($bdOpen);
    echo json_encode($response);
}else{
    pg_close($bdOpen);
    echo json_encode($response);
}
?>