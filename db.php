<?php
$host = 'localhost'; // ou o IP do seu servidor
$dbname = 'pizzaria'; // Nome do banco de dados
$username = 'root'; // Seu usuário do MySQL
$password = ''; // Senha do MySQL, se houver

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
?>
