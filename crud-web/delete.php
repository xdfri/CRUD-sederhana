<?php
include 'services/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: index.php");
exit();
?>
