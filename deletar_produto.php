<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id_produto = :id_produto");
    $stmt->bindParam(':id_produto', $id_produto);

    if ($stmt->execute()) {
        echo "Produto excluído com sucesso!";
        header('Location: index.php');
    } else {
        echo "Erro ao excluir produto!";
    }
}
?>
