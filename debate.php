<?php
require "./configs/conexao.php";

// array for JSON response
$response = array();

if (isset($_POST['tvDescDebate']) && isset($_POST['tvDescDebate'])) {


    //check for required fields
    $tvDescDebate = trim($_POST['tvDescDebate']);
    $tvTitleTheme = trim($_POST['tvDescDebate']);

    $dataAtual = date("Y-m-d");
    $result = pg_query($bdOpen, "SELECT * FROM debate WHERE (dt_final > '$dataAtual')");


    //se retornar alguma linha, tem debate em andamento
    if (pg_num_rows($result) > 0) {
        //carregar o debate mais atual
        $row = pg_fetch_array($result);
        $id_tema = $row['fk_tema_id_tema'];

        $result = pg_query($bdOpen, "SELECT * FROM tema WHERE (id_tema = $id_tema)");
        $row = pg_fetch_array($result);
        $tvTitleTheme = $row['titulo'];
        $tvDescDebate = $row['descricao'];


        pg_close($bdOpen);
        echo json_encode($response);
        //carregar comentarios

    } else {

        //tema mais votado
        $result = pg_query($bdOpen, "SELECT curtida.fk_tema_id_tema, COUNT(*)
        FROM curtida LEFT JOIN debate as d
        ON curtida.fk_tema_id_tema = d.fk_tema_id_tema
        WHERE d.FK_TEMA_id_tema is null
        GROUP BY curtida.fk_tema_id_tema
        ORDER BY COUNT(*) DESC LIMIT 1");
        $row = pg_fetch_array($result);
        $tema_ganhador = $row['fk_tema_id_tema'];

        //inserção na tabela debate
        $dt_final = date("Y-m-d", strtotime('+1 week'));
        pg_query($bdOpen, "INSERT INTO debate (dt_inicio, dt_final, fk_tema_id_tema)
        values ($dataAtual, $dt_final, $tema_ganhador)");

        //preenchendo tela
        $result = pg_query($bdOpen, "SELECT * FROM tema WHERE (id_tema = $tema_ganhador)");
        $row = pg_fetch_array($result);
        $tvTitleTheme = $row['titulo'];
        $tvDescDebate = $row['descricao'];

        pg_close($bdOpen);
        echo json_encode($response);

        //recyclerview em branco
    }

    //check erro
    if ($result) {
        $response["success"] = 1;

        $response["message"] = "Campoo titulo e descricao criado com sucesso";

        pg_close($bdOpen);
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["error"] = "Error BD: " . pg_last_error($bdOpen);

        pg_close($bdOpen);
        echo json_encode($response);
    }
} else {

    $response["success"] = 0;
    $response["message"] = "Campo titulo e descricao nao preenchido";


    pg_close($bdOpen);
    echo json_encode($response);
}
