<?php
require_once __DIR__ . '/../app/Models/Book.php';

use App\Models\Book;

if (isset($_GET['id'])) {
    $bookModel = new Book();
    $book = $bookModel->find($_GET['id']);

    if (!$book) {
        echo 'Book not found!';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updatedData = [
            'title' => $_POST['title'],
            'isbn' => $_POST['isbn'],
            'author' => $_POST['author'],
            'publisher' => $_POST['publisher'],
            'year_published' => $_POST['year_published'],
            'category' => $_POST['category'],
        ];

        $success = $bookModel->update($_GET['id'], $updatedData);

        if ($success) {
            echo '<div class="alert alert-success" role="alert">Book updated successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating book. Please try again.</div>';
        }
    }
} else {
    echo 'Book ID is missing!';
    exit;
}
