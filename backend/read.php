<?php
/**
 * list_books.php
 * Fetch and display all books from the database.
 */

// Include reusable database functions
require_once 'init.php';

// Open DB connection
$connection = openConnection();

// Run query
$sql = "SELECT id, title, author, year FROM books";
$result = $connection->query($sql);

// Check query result
if (!$result || $result->num_rows === 0) {
    echo "No books found." . PHP_EOL;
} else {
    echo "Found {$result->num_rows} book(s):" . PHP_EOL;
    echo str_repeat('=', 40) . PHP_EOL;

    while ($book = $result->fetch_assoc()) {
        printf(
            "ID: %d\nTitle: %s\nAuthor: %s\nYear: %d\n%s\n",
            $book['id'],
            $book['title'],
            $book['author'],
            $book['year'],
            str_repeat('-', 40)
        );
    }
}

// Clean up
$result->free();
closeConnection($connection);

echo "Done." . PHP_EOL;
?>
