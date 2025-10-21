<?php
/**
 * init.php
 * Handles database connection setup and teardown.
 */

function openConnection(): mysqli {
    $DB_HOST = 'mysql';
    $DB_USER = 'root';
    $DB_PASS = 'rootpass';
    $DB_NAME = 'library';

    $connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error . PHP_EOL);
    }

    return $connection;
}

function closeConnection(mysqli $connection): void {
    $connection->close();
}
?>
