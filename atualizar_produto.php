<?php
include 'db.php';


if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];


    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id_produto");
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->execute();
    $produto = $stmt->fetch();

    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID do produto não fornecido!";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $unidade = $_POST['unidade'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];

    if (empty($nome) || empty($unidade) || empty($preco) || empty($categoria_id)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }


    $sql = "UPDATE produtos SET nome = :nome, unidade = :unidade, preco = :preco, categoria_id = :categoria_id WHERE id_produto = :id_produto";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':unidade', $unidade);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->bindParam(':id_produto', $id_produto);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
        header('Location: index.php');
    } else {
        echo "Erro ao atualizar produto!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="shortcut icon" href="./img/construcao.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Atualizar Produto</h1>
        <a href="index.php" class="btn">Voltar</a>
    </header>

    <section class="form-container">
        <form method="POST">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" value="<?= $produto['nome']; ?>" required><br>

            <label for="unidade">Unidade:</label>
            <input type="number" id="unidade" name="unidade" value="<?= $produto['unidade']; ?>" required><br>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" value="<?= $produto['preco']; ?>" required><br>

            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" required>
                <?php
                
                $stmt = $pdo->query("SELECT * FROM categorias");
                while ($row = $stmt->fetch()) {
                    $selected = ($row['id_categoria'] == $produto['categoria_id']) ? 'selected' : '';
                    echo "<option value='{$row['id_categoria']}' $selected>{$row['nome']}</option>";
                }
                ?>
            </select><br>

            <button type="submit">Atualizar</button>
        </form>
    </section>
</body>
</html>
