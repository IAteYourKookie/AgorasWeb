<?php

$db_name = 'd8e16dgc7gld9j';
    $db_host ='ec2-18-213-133-45.compute-1.amazonaws.com';
    $db_user = 'wyclwmamsumncs';
    $db_pass = '886abfe44d00cf375f1ef5c13d290cb28cb8b1452cce70c27858c209b5a75bdd';
    
    extension_loaded('pgsql') ? 'yes':'no';
    
    $bdOpen = pg_connect("postgres://wyclwmamsumncs:886abfe44d00cf375f1ef5c13d290cb28cb8b1452cce70c27858c209b5a75bdd@ec2-18-213-133-45.compute-1.amazonaws.com:5432/d8e16dgc7gld9j") or pg_last_error();
    $response["success"] = "conexão efetuada com sucesso";

?>