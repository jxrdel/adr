<?php
$serverName = "00-HV-DBS-01"; // Server name or IP address
$databaseName = "HS_AdmissionDischargeV2"; // Database name
$username = "hs_admissiondischargeapp-user"; // Database username
$password = "s7a7is7ics"; // Database password

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$databaseName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to SQL Server database successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>