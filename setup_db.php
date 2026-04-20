<?php
$conn = mysqli_connect('localhost', 'root', '');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_file = file_get_contents('database.sql');
$queries = explode(';', $sql_file);

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if (mysqli_query($conn, $query)) {
            echo "✓ Executed: " . substr($query, 0, 50) . "...\n";
        } else {
            echo "✗ Error: " . mysqli_error($conn) . "\n";
        }
    }
}

echo "\nDatabase setup complete!";
mysqli_close($conn);
?>