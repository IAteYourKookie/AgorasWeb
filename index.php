<html><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
    </style>
</head><body>
<?php
    $db_name = 'd8e16dgc7gld9j';
    $db_host ='ec2-18-213-133-45.compute-1.amazonaws.com';
    $db_user = 'wyclwmamsumncs';
    $db_pass = '886abfe44d00cf375f1ef5c13d290cb28cb8b1452cce70c27858c209b5a75bdd';
    
    extension_loaded('pgsql') ? 'yes':'no';
    
    $bdOpen = pg_connect("postgres://wyclwmamsumncs:886abfe44d00cf375f1ef5c13d290cb28cb8b1452cce70c27858c209b5a75bdd@ec2-18-213-133-45.compute-1.amazonaws.com:5432/d8e16dgc7gld9j") or pg_last_error();
    //caso a conexão seja efetuada com sucesso, exibe uma mensagem ao usuário
    echo "Conexão efetuada com sucesso!!";


    $dados = array();

    $sql = 'SELECT * FROM usuarios';
    $res = pg_query($bdOpen, $sql);

    if (pg_num_rows($res) > 0) {
        while ($user = pg_fetch_array($res)) {
            $dados['Usuarios'][] = array(
                'id_usuario' => intval($user['id_usuario']),
                'nome' => $user['nome'],
                'nome_de_usuario' => $user['nome_de_usuario'],
                'senha' => $user['senha'],
                'email' => $user['email']
            );
        }
    }
    echo json_encode($dados);
    print_r($user);
    
    /*$sql = "SELECT * FROM usuarios";
    $aux = pg_query($bdOpen,$sql);

    echo "<p>Usuario</p><table>";

    while ($arq = pg_fetch_array($aux)){
        $nome = $arq["nome"];
        $nomeUsuario =$arq["nome_de_usuario"];
        $senha = $arq["senha"];
        $email = $arq["email"];
        $idUsuario = $arq["id_usuario"];

        echo "<tr><td>$idUsuario</td><td>$nomeUsuario</td><td>$nome</td><td>$email</td><td>$senha</td></tr>";
    }
    echo "</table>";

    $sql = "SELECT * FROM tema";
    $aux = pg_query($bdOpen,$sql);

    echo "<p>Tema</p><table>";

    while ($arq = pg_fetch_array($aux)){
        $titulo = $arq["titulo"];
        $desc = $arq["descricao"];
        $idTema = $arq["id_tema"];

        echo "<tr><td>$titulo</td><td>$desc</td><td>$idTema</td></tr>";
    }

    echo "</table>";

    $sql = "SELECT * FROM debate";
    $aux = pg_query($bdOpen,$sql);

    echo "<p>Debate</p><table>";

    while ($arq = pg_fetch_array($aux)){
        $idDebate = $arq["id_debate"];
        $idTema = $arq["id_tema"];
        $dtInicio = $arq["dt_inicio"];
        $dtFinal = $arq["dt_final"];

        echo "<tr><td>$idDebate</td><td>$idTema</td><td>$dtInicio</td><td>$dtFinal</td></tr>";
    }

    echo "</table>";*/
?>
</body></html>