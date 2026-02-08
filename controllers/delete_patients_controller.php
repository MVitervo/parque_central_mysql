<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../connection.php';

$id = $_POST['id'] ?? null;

try {
    $conn->beginTransaction();

    $deletePatients = $conn->prepare("DELETE FROM Patients_tbl WHERE id = :id");

    $deletePatients->bindParam(':id', $id, PDO::PARAM_INT);

    $deletePatients->execute();
    $conn->commit();

    echo json_encode(['status'=>true, 'message'=>"Eliminado correctamente"]);
    
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(['status'=>false, 'message'=>"Error de base de datos ".$e->getMessage()]);
}



