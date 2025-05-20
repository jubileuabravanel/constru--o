<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $unidade = $_POST['unidade'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];

    if (empty($nome) || empty($unidade) || empty($preco) || empty($categoria_id)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    // Inserir dados no banco
    $sql = "INSERT INTO produtos (nome, unidade, preco, categoria_id) VALUES (:nome, :unidade, :preco, :categoria_id)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':unidade', $unidade);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':categoria_id', $categoria_id);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
        header('Location: index.php');
    } else {
        echo "Erro ao cadastrar produto!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastrar Produto</h1>
        <a href="index.php" class="btn">Voltar</a>
    </header>

    <section class="form-container">
        <form method="POST">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="unidade">Unidade:</label>
            <input type="number" id="unidade" name="unidade" required><br>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required><br>

            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" required>
                <?php
                $stmt = $pdo->query("SELECT * FROM categorias");
                while ($row = $stmt->fetch()) {
                    echo "<option value='{$row['id_categoria']}'>{$row['nome']}</option>";
                }
                ?>
            </select><br>

            <button type="submit">Cadastrar</button>
        </form>
    </section>
</body>
</html>
