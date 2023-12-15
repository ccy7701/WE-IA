<?php
    // mysqli_connect is used for database connection
    $databaseHost = 'localhost';
    $databaseUsername = 'root';
    $databasePassword = '';
    $databaseName = 'mystudykpi';

    $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    // check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
?>