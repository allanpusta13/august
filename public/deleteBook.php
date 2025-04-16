<?php

require_once __DIR__ . '/../app/Models/Book.php';

use App\Models\Book;

if (isset($_POST['id'])) {
    $bookId = $_POST['id'];
    $book = new Book();

    if ($book->delete($bookId)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete book']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No book ID provided']);
}