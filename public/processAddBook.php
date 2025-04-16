<?php

// die('kjagsdsa');

require_once __DIR__ . '/../app/Models/Book.php';

use App\Models\Book;

$title = $isbn = $author = $publisher = $year_published = $category = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_REQUEST['title'];
    $isbn = $_REQUEST['isbn'];
    $author = $_REQUEST['author'];
    $publisher = $_REQUEST['publisher'];
    $year_published = $_REQUEST['year_published'];
    $category = $_REQUEST['category'];

    $newBook = new Book();

    $success = $newBook->create([
        'title' => $title,
        'isbn' => $isbn,
        'author' => $author,
        'publisher' => $publisher,
        'year_published' => $year_published,
        'category' => $category
    ]);

    if ($success) {
        header("Location: index.php");
    } else {
        header("Location: index.php?error=add_failed");
    }
}
