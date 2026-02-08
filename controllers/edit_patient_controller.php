<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../connection.php';

// Recibir los datos del formulario
$id = (int)$_POST['id'];
$name = trim($_POST['txtName']);
$lastname = trim($_POST['txtLastname']);
$curp = trim($_POST['txtCurp']);
$rfc = trim($_POST['txtRfc']);


try {
    // Iniciar la transacción
    $conn->beginTransaction();
    // Se actualizo el archivo
    
    $queryUpdatePatient = "UPDATE Patients_tbl
                    SET Name = :name
                    ,Lastname = :lastname
                    ,CURP = :curp
                    ,RFC = :rfc
                    WHERE id = :id";
    
    $updatePatient = $conn->prepare($queryUpdatePatient);
    $updatePatient->bindParam(':name', $name, PDO::PARAM_STR);
    $updatePatient->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $updatePatient->bindParam(':curp', $curp, PDO::PARAM_STR);
    $updatePatient->bindParam(':rfc', $rfc, PDO::PARAM_STR);
    $updatePatient->bindValue(':id', $id, PDO::PARAM_INT);
    $updatePatient->execute();

    // Confirmar la transacción si todo está bien
    $conn->commit();

    // Ejemplo de respuesta exitosa
    echo json_encode([
        'status' => true,
        'message' => 'Cambios guardados'
    ]);
} catch (Exception $e) {
    // Ocurrió un error, revertir la transacción
    $conn->rollBack();
    echo json_encode(['status' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    // Cerrar la conexión
    $conn = null;
}