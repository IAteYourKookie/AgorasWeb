<!-- Tabelas 
id = primary auto_increment 
arquivo = varchar 40 
data_photo = datetime 
-->

<?php
require "./configs/conexao.php";
session_start();

if (isset($_FILES['arquivo'])) {
    $msg = false;

    $arquivo = strtolower(substr($_FILES['arquivo']['name'], -4));
    $newarquivo = md5(time()) . $arquivo;
    $dir = "uploads/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $newarquivo);


    $sql = "INSERT INTO arquivo(id, arquivo, data_photo) VALUES(null, '$newarquivo', NOW());";
    if (mysqli_query($dbOpen, $sql)) {
        $msg = "Arquivo enviado com sucesso!!";
    } else {
        $msg = "Falha ao enviar arquivo.";
    }

    //erro
    if ($msg != false) {
        echo "<p>$msg</p>";
    }
}
?>

<h1 class="text-center">Formulário de Upload de Arquivos</h1>
<form name="form" action="upload.php" method="post" enctype="multipart/form-data">
    Arquivo:<br>
    <input type="file" required name="arquivo">
    <br><br>
    <input type="submit" class="btn btn-primary" name="file" value="Enviar">
</form>