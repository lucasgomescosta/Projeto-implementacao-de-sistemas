<?php

;


try {
    $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('DELETE FROM usuario WHERE id = :id');
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    header("Location: users.php");

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}