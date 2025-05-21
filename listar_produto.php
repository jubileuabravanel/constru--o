<?php
include 'db.php';


$orderBy = isset($_GET['order']) ? $_GET['order'] : 'nome';

$query = "SELECT p.id_produto, p.nome, p.unidade, p.preco, c.nome AS categoria FROM produtos p
          JOIN categorias c ON p.categoria_id = c.id_categoria ORDER BY $orderBy ASC";

$stmt = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="shortcut icon" href="./img/construcao.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lista de Produtos</h1>
        <a href="cadastrar_produto.php" class="btn">Cadastrar Novo Produto</a>
    </header>

    <section class="filters">
        <form action="listar_produtos.php" method="GET">
            <label for="order">Ordenar por:</label>
            <select name="order" id="order" onchange="this.form.submit()">
                <option value="nome" <?php echo ($orderBy == 'nome') ? 'selected' : ''; ?>>Nome</option>
                <option value="preco" <?php echo ($orderBy == 'preco') ? 'selected' : ''; ?>>Preço</option>
                <option value="unidade" <?php echo ($orderBy == 'unidade') ? 'selected' : ''; ?>>Quantidade</option>
            </select>
        </form>
    </section>

    <section class="product-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Unidade</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr class="<?= ($row['unidade'] <= 5) ? 'stock-low' : ''; ?>">
                        <td><?= $row['id_produto']; ?></td>
                        <td><?= $row['nome']; ?></td>
                        <td><?= $row['unidade']; ?></td>
                        <td>R$ <?= number_format($row['preco'], 2, ',', '.'); ?></td>
                        <td><?= $row['categoria']; ?></td>
                        <td>
                            <a href="atualizar_produto.php?id=<?= $row['id_produto']; ?>">Editar</a> |
                            <a href="deletar_produto.php?id=<?= $row['id_produto']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
