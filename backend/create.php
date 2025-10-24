<?php
$DB_HOST = 'mysql';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'rootpass';
$DB_NAME = 'library';

$connection = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD);

if ($connection->connect_error) {
    die("Connection Error: " . $connection->connect_error . PHP_EOL);
}

$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!$connection->query($sql)) {
    die("Database creation failed: " . $connection->error . PHP_EOL);
}

echo "Database '$DB_NAME' ready.\n";

$connection->select_db($DB_NAME);

$table_sql = "
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$connection->query($table_sql)) {
    die("Table creation failed: " . $connection->error . PHP_EOL);
}

echo "Table 'books' ready.\n";

$word_list = ['HI', 'Hello', 'Hey', 'Hoo', 'Hee'];

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

$x = 0;
while ($x < 100000) {
    $ran = rand(0, 4);
    $ran2 = rand(0, 4);

    $title = $word_list[$ran];
    $author = $word_list[$ran] . ' ' . $word_list[$ran2];
    $description = generateRandomString();
    $year = rand(1980, 2026);

    $sql = 'INSERT INTO books (title, author, description, year) VALUES (?, ?, ?, ?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $title, $author, $description, $year);
    $stmt->execute();
    $stmt->close();

    $x++;
}

$connection->close();

echo "Successfully inserted 100,000 random records into 'books'.\n";
?>
