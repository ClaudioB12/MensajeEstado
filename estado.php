<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "control_estado";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Conexión fallida: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estado = (int)$_POST['estado'];
    $sql = "UPDATE estado SET estado = $estado WHERE id = 1";
    if (!$conn->query($sql)) {
        die(json_encode(['error' => 'Error al actualizar: ' . $conn->error]));
    }
}

$result = $conn->query("SELECT estado FROM estado WHERE id = 1");
if (!$result) {
    die(json_encode(['error' => 'Error al consultar: ' . $conn->error]));
}

$row = $result->fetch_assoc();
echo json_encode(['estado' => (int)$row['estado']]);

$conn->close();
?>