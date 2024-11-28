<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o pedido foi excluído
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: pedidos.php');
    exit;
}

// Verifica se o status do pedido foi alterado
if (isset($_GET['atualizar_status'])) {
    $id = $_GET['atualizar_status'];
    $sql = "UPDATE pedidos SET status = CASE 
                WHEN status = 'A fazer' THEN 'Em preparação' 
                WHEN status = 'Em preparação' THEN 'Pronto' 
                WHEN status = 'Pronto' THEN 'A fazer' 
            END WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: pedidos.php');
    exit;
}

// Consulta os pedidos e os dados dos clientes
$sql = "SELECT pedidos.*, clientes.nome_cliente, clientes.telefone_cliente, clientes.endereco_cliente
        FROM pedidos 
        JOIN clientes ON pedidos.cliente_id = clientes.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pedidos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Pizzaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Pedido</a>
        <a href="pedidos.php">Visualizar Pedidos</a>
        <a href="cadastro.php">Cadastrar Cliente</a>
    </nav>

    <h1>Pedidos</h1>
    <div class="colunas">
        <!-- Pedidos a fazer -->
        <div class="coluna">
            <h2>Pedidos a Fazer</h2>
            <?php foreach ($pedidos as $pedido): ?>
                <?php if ($pedido['status'] == 'A fazer'): ?>
                    <div class="pedido">
                        <p><strong>Cliente:</strong> <?php echo $pedido['nome_cliente']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $pedido['telefone_cliente']; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $pedido['endereco_cliente']; ?></p>
                        <p><strong>Sabor:</strong> <?php echo $pedido['sabor_pizza']; ?></p>
                        <p><strong>Quantidade:</strong> <?php echo $pedido['quantidade_pizza']; ?></p>
                        <p><strong>Observação:</strong> <?php echo $pedido['observacao']; ?></p>
                        <p><strong>Status:</strong> <?php echo $pedido['status']; ?></p>
                        <a href="?atualizar_status=<?php echo $pedido['id']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $pedido['id']; ?>">Excluir Pedido</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Pedidos em preparação -->
        <div class="coluna">
            <h2>Pedidos em Preparação</h2>
            <?php foreach ($pedidos as $pedido): ?>
                <?php if ($pedido['status'] == 'Em preparação'): ?>
                    <div class="pedido">
                        <p><strong>Cliente:</strong> <?php echo $pedido['nome_cliente']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $pedido['telefone_cliente']; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $pedido['endereco_cliente']; ?></p>
                        <p><strong>Sabor:</strong> <?php echo $pedido['sabor_pizza']; ?></p>
                        <p><strong>Quantidade:</strong> <?php echo $pedido['quantidade_pizza']; ?></p>
                        <p><strong>Observação:</strong> <?php echo $pedido['observacao']; ?></p>
                        <p><strong>Status:</strong> <?php echo $pedido['status']; ?></p>
                        <a href="?atualizar_status=<?php echo $pedido['id']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $pedido['id']; ?>">Excluir Pedido</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Pedidos prontos -->
        <div class="coluna">
            <h2>Pedidos Prontos</h2>
            <?php foreach ($pedidos as $pedido): ?>
                <?php if ($pedido['status'] == 'Pronto'): ?>
                    <div class="pedido">
                        <p><strong>Cliente:</strong> <?php echo $pedido['nome_cliente']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $pedido['telefone_cliente']; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $pedido['endereco_cliente']; ?></p>
                        <p><strong>Sabor:</strong> <?php echo $pedido['sabor_pizza']; ?></p>
                        <p><strong>Quantidade:</strong> <?php echo $pedido['quantidade_pizza']; ?></p>
                        <p><strong>Observação:</strong> <?php echo $pedido['observacao']; ?></p>
                        <p><strong>Status:</strong> <?php echo $pedido['status']; ?></p>
                        <a href="?atualizar_status=<?php echo $pedido['id']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $pedido['id']; ?>">Excluir Pedido</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
