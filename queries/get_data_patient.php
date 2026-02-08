<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../connection.php';

$id = (int)$_POST['id'];

try {

    $queryGetDataPatient= "SELECT * FROM Patients_tbl WHERE id = :id";

    $getDataPatient = $conn->prepare($queryGetDataPatient);

    $getDataPatient->bindValue(':id', $id, PDO::PARAM_INT);

    $getDataPatient->execute();
    
    $data = $getDataPatient->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => true,
        'data' => $data
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'status' => false,
        'message'=>"Error de base de datos " . $e->getMessage()
    ]);
} finally {
    $conn = null;
}



