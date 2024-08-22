<?php 

require 'conexao.php';

if (isset($_SERVER['delete_usuario'])) { 
    $usuario_id = mysqli_escape_string($conexao, trim($_POST['id']));

    $sql = "DELETE FROM `usuarios` WHERE id = '$id'";
}

mysqli_query($conexao, $sql);
?>
