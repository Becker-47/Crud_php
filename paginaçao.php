<?php

require 'conexao.php';


$reg_por_pagina = 5;


$p = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$p = $pagina < 1 ? 1 : $pagina;


$inicio = ($pagina - 1) * $reg_por_pagina;


$sql_count = "SELECT COUNT(*) as total FROM usuarios";
$result_count = mysqli_query($conexao, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_registros = $row_count['total'];

// Calcular o número total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Determinar a página atual
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina_atual = max($pagina_atual, 1); // Garantir que a página não seja menor que 1
$pagina_atual = min($pagina_atual, $total_paginas); // Garantir que a página não exceda o total de páginas

// Calcular o OFFSET para a consulta
$offset = ($pagina_atual - 1) * $registros_por_pagina;

// Consulta para buscar os usuários da página atual
$sql = "SELECT * FROM usuarios LIMIT $registros_por_pagina OFFSET $offset";
$result = mysqli_query($conexao, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginação</title>
</head>
<body>
    <style>
        body{
            background-image: url(projeto-de-plano-de-fundo-de-tecnologia-branca-abstrata-ilustracao-vetorial-moderna_29865-6047.jpg);    
        }
        tr{
            font-size: 20px;
            border-bottom-color: aqua;    
            border-radius: 15px;       
        }
        td{
            font-size: large;
            background-color: aqua;
        }
        p{
            font-style: normal;
            font-size: large;
            background-color: blueviolet;
        }
        a{
            font-size:x-large;
            background-color: cadetblue;
        }
        table{
            font-size: x-large;
        }
        .border{
            background-color: chocolate;
            font-size: x-large;
        }     
    </style>
    <h1>Lista de Usuários</h1> 
    <a href="index.php" class="btn btn-danger float-end">Voltar para pagina atual</a>
    <table border = "3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['data_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Exibir links de paginação -->
    <div>
        <?php if ($p > 1): ?>
            <a href="?p=<?php echo ($p - 1); ?>">&laquo; Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <?php if ($i == $p): ?>
                <span><?php echo $i; ?></span>
            <?php else: ?>
                <a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($p < $total_paginas): ?>
            <a href="?p=<?php echo ($p + 1); ?>">Próximo &raquo;</a>
        <?php endif; ?>
    </div>

    <?php
    // Fechar conexão
    mysqli_close($conexao);
    ?>
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
