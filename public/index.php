<?php
require_once __DIR__ . '/../app/Models/Book.php';

use App\Models\Book;

$bookModel = new Book();
$books = $bookModel->all();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php } ?>
        <h2>Book Catalog</h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#bookForm">Add New Book</button>

        <?php include 'book_form.php'; ?>

        <br>
        <br>
        <table class="table table-striped" id="booksTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= $book->title ?></td>
                        <td><?= $book->isbn ?></td>
                        <td><?= $book->author ?></td>
                        <td><?= $book->publisher ?></td>
                        <td><?= $book->year_published ?></td>
                        <td><?= $book->category ?></td>
                        <td>
                            <button class="btn btn-primary editButton" data-id="<?= htmlspecialchars($book->id) ?>">Edit</button>
                            <button class="btn btn-danger" onclick="deleteBook(<?= $book->id ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="editBookForm">
                        <div class="modal-body">
                            <input type="hidden" id="bookId" name="id">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="form-group">
                                <label for="publisher">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" required>
                            </div>
                            <div class="form-group">
                                <label for="year_published">Year Published</label>
                                <input type="number" class="form-control" id="year_published" name="year_published" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable();
            $('.editButton').click(function() {
                var bookId = $(this).data('id');
                $.ajax({
                    url: 'getBook.php',
                    method: 'GET',
                    data: {
                        id: bookId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#editBookModal #bookId').val(response.id);
                        $('#editBookModal #title').val(response.title);
                        $('#editBookModal #isbn').val(response.isbn);
                        $('#editBookModal #author').val(response.author);
                        $('#editBookModal #publisher').val(response.publisher);
                        $('#editBookModal #year_published').val(response.year_published);
                        $('#editBookModal #category').val(response.category);
                        $('#editBookModal').modal('show');
                    }
                });
            });

            $('#editBookForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: 'updateBook.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Book updated successfully!');
                        location.reload();
                    },
                    error: function() {
                        alert('Error updating book!');
                    }
                });
            });
        });

        function deleteBook(bookId) {
            if (confirm("Are you sure you want to delete this book?")) {
                $.ajax({
                    url: 'deleteBook.php',
                    method: 'POST',
                    data: {
                        id: bookId
                    }, 
                    success: function(response) {
                        alert("Book deleted successfully.");
                        location.reload(); 
                    },
                    error: function() {
                        alert("An error occurred while deleting the book.");
                    }
                });
            }
        }
    </script>
</body>

</html>