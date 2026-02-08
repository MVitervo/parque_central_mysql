<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../connection.php';

$name = $_POST['txtName'] ?? null;
$first_surname = $_POST['txtLastname'] ?? null;
$curp = $_POST['txtCurp'] ?? null;
$rfc = $_POST['txtRfc'] ?? null;

try {
    $conn->beginTransaction();

    $insertPatients = $conn->prepare("INSERT INTO Patients_tbl (Name, Lastname, CURP, RFC) VALUES (:Name, :Lastname, :CURP, :RFC)");
    $insertPatients->bindParam(':Name', $name, PDO::PARAM_STR);
    $insertPatients->bindParam(':Lastname', $first_surname, PDO::PARAM_STR);
    $insertPatients->bindParam(':CURP', $curp, PDO::PARAM_STR);
    $insertPatients->bindParam(':RFC', $rfc, PDO::PARAM_STR);

    $insertPatients->execute();
    $conn->commit();

    echo json_encode(['status'=>true, 'message'=>"Registrado correctamente"]);
    
} catch (PDOException $e) {
    $conn->rollBack();
echo json_encode(['status'=>false, 'message'=>"Error de base de datos ".$e->getMessage()]);
}



