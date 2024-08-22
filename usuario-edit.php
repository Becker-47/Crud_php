<?php
require 'conexao.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    
    if ($conexao === false) {
        die("Erro ao conectar ao banco de dados.");
    }

    $stmt = $conexao->prepare('SELECT * FROM usuarios WHERE id = ?');
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        $usuario = null;
    }

    $stmt->close();
} else {
    $usuario = null;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <style>
        body{
            background-image: url(fundo-abstrato-preto-tecnologia_115579-113.jpg);
        }
        label{
            background-color: aqua;
            font-size: 20px;
        }
        input{
            font-size: 15px;
        }
    </style>
    <?php include ('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar
                        <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            <div class="mb-5">
                                <label>Nome</label>
                                <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']); ?>" class="form-control">
                            </div>                         
                            <div class="mb-5">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" class="form-control">
                            </div>
                            <div class="mb-5">
                                <label>Data Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control">
                            </div>
                            <div class="mb-5">
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="form-control">
                            </div>
                            <div class="mb-5">
                                <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
