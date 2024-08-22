<?php
require 'conexao.php'; 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <style>
        body{
            background-image: url(internet-technology-hg-3840x2160.jpg);
        }
        .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    </style>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Cadastro de Usuários
                            <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar Usuário</a>    
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Data Nascimento</th>
                                    <th>Telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $sql = 'SELECT * FROM usuarios';
                                $usuarios = mysqli_query($conexao, $sql);
                                if ($usuarios && mysqli_num_rows($usuarios) > 0) {
                                    while ($usuario = mysqli_fetch_assoc($usuarios)) {
                                ?>
                                    <tr>
                                        <td>
                                        <span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
                                        </td>
                                        <td><?= htmlspecialchars($usuario['nome']); ?></td>
                                        <td><?= htmlspecialchars($usuario['email']); ?></td>
                                        <td><?= htmlspecialchars($usuario['data_nascimento']); ?></td>
                                        <td><?= htmlspecialchars($usuario['telefone']); ?></td>

                                        <td>
                                            <a href="usuario-view.php?id=<?= htmlspecialchars($usuario['id']); ?>" class="btn btn-info btn-sm">Visualizar</a>
                                            <a href="usuario-edit.php?id=<?= htmlspecialchars($usuario['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="acoes.php" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                                <input type="hidden" name="id-deletar" value="<?= htmlspecialchars($usuario['id']); ?>">
                                                <button type="submit" name="delete_usuario" class="btn btn-danger btn-sm">Excluir</button>                                    
                                            </form>
                                            <form action="paginaçao.php" method="POST" class="d-inline" onsubmit="return confirm('Quer ir para proxima pagina?');">
                                            
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">Nenhum usuário encontrado</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<div class="clearfix">
					<div class="hint-text"> Total de Paginas <b>5</b> De Usuarios <b>25</b> total </div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#"></a> Quantidade De Pagina </li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Proxima Pagina</a></li>
					</ul>
				</div>
</html>