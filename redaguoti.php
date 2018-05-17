<?php 

// Prisijungimo duomenys
$servername = 'localhost';
$dbname = 'Auto';
$username = 'root';
$password = 'mysql';

// Prisijungiame prie duomenų bazės 
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_REQUEST['id'];
$data = $_REQUEST['data'];
$numeris = $_REQUEST['numeris'];
$kelias = $_REQUEST['kelias'];
$laikas = $_REQUEST['laikas'];

// Suformuojame UPDATE užklausą
$sql = "UPDATE `radars` SET `date` = ?, `number` = ?, `distance` = ?, `time` = ? WHERE `id` = ?"; 
$stmt = $conn->prepare($sql);

// Priskiriame parametrų reikšmes
$stmt->bind_param("ssddi", $data, $numeris, $kelias, $laikas, $id);

// Vykdome UPDATE užklausą
$stmt->execute();


echo json_encode([success => true]);