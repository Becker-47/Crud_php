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
    <title>Visualizar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <style>
        label{
            background-color: aqua;
            margin-bottom: 10px;
            font-size: 26px;
        }
        body{
            background-image: url(fundo-abstrato-preto-tecnologia_115579-113.jpg);
        }
        p{
            font-size: 20px;
            background-color: blue;
        }
    </style>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($usuario): ?>
                            <div class="mb-3">
                                <label>Nome</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($usuario['nome']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($usuario['email']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Data de Nascimento</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($usuario['data_nascimento']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Telefone</label>
                                <p class="form-control-plaintext"><?= htmlspecialchars($usuario['telefone']); ?></p>
                            </div> 
                        <?php else: ?>
                            <h5 class="text-center">Nenhum usuário encontrado</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>