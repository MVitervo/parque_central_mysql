<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../connection.php';

$response = array();

try {
    $queryGetPatients = $conn->prepare(
        "SELECT * FROM Patients_tbl ORDER BY Id DESC"
    );

    $queryGetPatients->execute();
    
    while ($result = $queryGetPatients->fetch(PDO::FETCH_ASSOC)) {
        // Inserta la fila actual
        $btnDelete = '<span style="cursor: pointer;" class="material-icons delete-btn text-danger" onclick="deletePatient('.$result['Id'].')">delete</span>';
        $row = array(
            'Name' => $result['Name'],
            'Lastname' => $result['Lastname'],
            'CURP' => $result['CURP'],
            'RFC' => $result['RFC'],
            'option' => $btnDelete
        );
        $response[] = $row;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

echo json_encode($response);

