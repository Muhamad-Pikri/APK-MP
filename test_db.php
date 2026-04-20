<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = mysqli_connect('localhost', 'root', '', 'kreaplin');
    echo "Database connection successful";
    
    $result = mysqli_query($conn, "SHOW TABLES");
    echo "\nTables in kreaplin:\n";
    while ($row = mysqli_fetch_array($result)) {
        echo "- " . $row[0] . "\n";
    }
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>