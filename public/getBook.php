<?php

require_once __DIR__ . '/../app/Models/Book.php';

use App\Models\Book;

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    $book = new Book();

    $bookData = $book->find((int) $bookId);

    if ($bookData) {
        echo json_encode($bookData);
    } else {
        echo json_encode(['error' => 'Book not found']);
    }
} else {
    echo json_encode(['error' => 'No book ID provided']);
}
