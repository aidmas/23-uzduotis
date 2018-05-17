<?php 

//error_reporting(0);

// Prisijungimo duomenys
$servername = 'localhost';
$dbname = 'Auto';
$username = 'root';
$password = 'mysql';

// Prisijungiame prie duomenų bazės 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        success => false,
        error =>$conn->connect_error
        
    ]);
    exit;
}

$data = $_REQUEST['data'];
$numeris = $_REQUEST['numeris'];
$kelias = $_REQUEST['kelias'];
$laikas = $_REQUEST['laikas'];

// Suformuojame INSERT užklausą
$sql = "INSERT INTO `radars`(`date`, `number`, `distance`, `time`) VALUES(?, ?, ?, ?)"; 
$stmt = $conn->prepare($sql);

if (!($stmt = $conn->prepare($sql))) {
    echo json_encode([
        success => false,
        error => $conn->error
    ]);
    exit;
};

// Priskiriame parametrų reikšmes
//$stmt->bind_param("ssdd", $data, $numeris, $kelias, $laikas);

if (!($stmt->bind_param("ssdd", $data, $numeris, $kelias, $laikas))) {
    echo json_encode([
        success => false,
        error => $stmt->error
    ]);
    exit;
}

// Vykdome INSERT užklausą
$stmt->execute();

// if (!($stmt->execute())) {
//     echo json_encode([
//         success => false,
//         error => $stmt->error
//     ]);
//     exit;

echo json_encode([success => true]);