<?php

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', ''); 
define('DB', 'usuarios');


$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);


if (!$conexao) {
    die('Não foi possível conectar: ' . mysqli_connect_error());
}


?>
