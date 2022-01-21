<?php

require "./configs/conexao.php";

// array for JSON response
$response = array();

// quando carregar a tela de votação e verificar quais já foram curtidas para mudar o ícone (vai pra votacao.php)

// vou percorrer a tabela Curtida na ordem da mais curtida pra menos, 
// fazer um array de cada tema (id do tema, nome do tema, descrição, curtidas)
// esse array vai estar dentro de outro array com todos os arrays dos outros temas

$query = pg_query($bdOpen, "SELECT curtida.fk_tema_id_tema, COUNT(*)
FROM curtida LEFT JOIN debate as d
ON curtida.fk_tema_id_tema = d.fk_tema_id_tema
WHERE d.FK_TEMA_id_tema is null
GROUP BY curtida.fk_tema_id_tema
ORDER BY COUNT(*) DESC");




//pesquisando umas coisas


//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
