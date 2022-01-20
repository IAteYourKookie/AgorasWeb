<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

$tvTitleTheme = NULL;
$tvDescDebate = NULL;
$tvDebates = NULL;

//check for required fields
$tvDescDebate = trim($_POST['tvDescDebate']);
$tvTitleTheme = trim($_POST['tvDescDebate']);

/* 
$result = pg_query($bdOpen, ""); 
*/

$dataAtual = date("Y-m-d");
$result = pg_query($bdOpen, "SELECT * FROM debate WHERE (dt_final > '$dataAtual')");


//se retornar alguma linha, tem debate em andamento
if (pg_num_rows($result) > 0) {
    //carregar o debate mais atual
    $row = pg_fetch_array($result);
    $id_tema = $row[3];

    $result = pg_query($bdOpen, "SELECT * FROM tema WHERE (id_tema = $id_tema)");
    $row = pg_fetch_array($result);
    $tvTitleTheme = $row[1];
    $tvDescDebate = $row[2];
    //echo $tvTitleTheme;
    //echo $tvDescDebate;
    //carregar comentarios
} else {
    //carregar um tema novo pro debate
    //usar select count()
    //fazer um select dos temas que não estão na tabela debate
    //com esse select, fazer a relação com as linhas de curtida e pegar a que tiver mais
    
    $result = pg_query($bdOpen, "SELECT t.* FROM tema as t 
    LEFT JOIN debate as d
    ON t.id_tema = d.FK_TEMA_id_tema
    WHERE  d.FK_TEMA_id_tema is null");
    $cont = pg_num_rows($result);
    for ($i=0; $i<$cont; $i++) {
        $row = pg_fetch_array($result);
        //isso aqui funciona? 
        $id_tema = $row['id_tema'];
        echo $id_tema;
        //ou tenho que usar isso?
        $id_tema = $row[0]; //ESSE EU SEI QUE DA CERTO, SO NAO SEI O DE CIMA
        //ou os dois fazem a mesma coisa?
    }
}


/* 
Fazer chave estrangeira entre fk_tema_id_tema e debate, para 
referenciar qual debate está sendo executado.
*/



//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

pg_close($bdOpen);
echo json_encode($response);
?>