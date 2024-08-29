<?php
$host = 'localhost';
$dbname = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$query = 'SELECT * FROM your_table'; 
$outputFile = 'export.csv'; 

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Execute the query
$stmt = $pdo->query($query);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($rows)) {
    die("No data found.");
}

// Open the output file in write mode
$fp = fopen($outputFile, 'w');
if ($fp === false) {
    die("Failed to open file for writing.");
}
fputcsv($fp, array_keys($rows[0]));
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo "Data successfully exported to $outputFile\n";
