<?php

require "./configs/conexao.php";

// array for JSON response
$response = array();

// quando carregar a tela de votação e verificar quais já foram curtidas para mudar o ícone (vai pra votacao.php)

// vou percorrer a tabela Curtida na ordem da mais curtida pra menos, 
// fazer um array de cada tema (id do tema, nome do tema, descrição, curtidas)
// esse array vai estar dentro de outro array com todos os arrays dos outros temas

$query = pg_query($bdOpen, "SELECT curtida.fk_tema_id_tema, COUNT(*) as curtidas 
FROM curtida LEFT JOIN debate as d
ON curtida.fk_tema_id_tema = d.fk_tema_id_tema
WHERE d.FK_TEMA_id_tema is null
GROUP BY curtida.fk_tema_id_tema 
ORDER BY COUNT(*) DESC");  


$cont = pg_num_rows($query);
$item_tema = array(); // array individual de cada tema que vai aparecer na votação 
// dentro do for eu inicializo o array novamente com chaves para facilitar a recuperação de dados
$vote_tema = array(); // array que possuiu os arrays de temas de votação

for($i = 0; $i < $cont; $i++) {
    $item_tema = array(
        "id_tema"   => "",
        "titulo"    => "",
        "descricao" => "",
        "curtidas"  => "",
    );
    $result = pg_fetch_array($query);
    $tema = pg_query($bdOpen, "SELECT titulo, descricao FROM tema WHERE id_tema = $result[fk_tema_id_tema]"); //conteudo do tema
    $conteudo = pg_fetch_array($tema);

    $item_tema["id_tema"] = $result['fk_tema_id_tema'];
    $item_tema["titulo"] = $conteudo['titulo'];
    $item_tema["descricao"] = $conteudo['descricao'];
    $item_tema["curtidas"] = $result['curtidas']; 

    $vote_tema[] = $item_tema; // array de arrays
}




//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
