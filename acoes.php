
<?php
require 'conexao.php'; 

if(isset($_POST['criar'])){

    $nome = mysqli_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_escape_string($conexao, trim($_POST['data_nascimento']));
    $telefone = mysqli_escape_string($conexao, trim($_POST['telefone']));
    
    $sql = "INSERT INTO usuarios (nome, email, data_nascimento, telefone ) VALUES ('$nome','$email','$data_nascimento','$telefone')";
    
    if (mysqli_query($conexao, $sql)) {

        print("alert('Inserido  com sucesso.'");

        header('Location: index.php');
    } else {

        echo "Erro ao inserir  registro: " . mysqli_error($conexao);
    }
}else if(!empty($_POST['nome'])){

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $id = mysqli_real_escape_string($conexao, trim($_POST['id']));
    
    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', data_nascimento = '$data_nascimento', telefone = '$telefone' WHERE id = '$id'";
    
    if (mysqli_query($conexao, $sql)) {

        print("alert('Registro atualizado com sucesso.'");
        header('Location: index.php');
    } else {

        echo "Erro ao atualizar o registro: " . mysqli_error($conexao);
    }
    
    
}else if(!empty($_POST['id-deletar'])){

    $sql = "DELETE FROM usuarios WHERE id=".$_POST['id-deletar'];
    mysqli_query($conexao, $sql);
    print("alert('Inserido  com sucesso.'");
    header('Location: index.php');
}


