<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload de arquivos com PHP</title>

    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        include "./includes/config.php";
        session_start();

        if (isset($_FILES['arquivo'])) {
            $msg = false;

            $arquivo = strtolower(substr($_FILES['arquivo']['name'], -4));
            $newarquivo = md5(time()) . $arquivo;
            $dir = "uploads/";

            move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $newarquivo);


            $sql = "INSERT INTO arquivo(id, arquivo, data) VALUES(null, '$newarquivo', NOW());";
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
    </div>
</body>

</html>