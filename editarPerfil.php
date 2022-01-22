
<?php
require "./configs/conexao.php";


// edição perfil
$imgPfp = NULL; // imagem atual 
$imgEditPhoto = NULL; // imagem de upload


//session de usuario
$login = trim($_POST['login']);
$newName = trim($_POST['editName']);
$newUser = trim($_POST['editUser']);
$newEmail = trim($_POST['editEmail']);
$newBio = trim($_POST['editBio']); 


//id => (SELECT id_usuario from usuario where email='$login');
$result = pg_query($bdOpen, "UPDATE usuario SET nome='$newName', nome_de_usuario='$newUser', email ='$newEmail', bio ='$bio' WHERE id_usuario=(SELECT id_usuario from usuario where email='$login')");

//check erro
if ($result) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
    $response["error"] = "Error BD: " . pg_last_error($bdOpen);
}

// update de imagem - atualizar img
/* 
    if (isset($_FILES['arquivo'])) {
        $msg = false;

        $arquivo = strtolower(substr($_FILES['arquivo']['name'], -4));
        $newarquivo = md5(time()) . $arquivo;
        $dir = "uploads/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $newarquivo);
        $id  = $_SESSION['id'];
        $sql = "UPDATE usuario SET arquivo = '$newarquivo' WHERE id_usuario=$id";
        if (mysqli_query($dbOpen, $sql)) {
            echo "<script type='text/javascript'>alert('Arquivo enviado com sucesso!!');</script>";
            echo "<script>javascript:window.location='./src/ticket.php';</script>";
        } else {
            $msg = "Falha ao enviar arquivo.";
        }
            //erro
        if ($msg != false) {
            echo "<p>$msg</p>";
        }
    }
     */

pg_close($bdOpen);
echo json_encode($response);
?>
