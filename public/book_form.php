<!-- Modal -->
<div class="modal fade" id="bookForm" tabindex="-1" aria-hidden="true">
    <form id="bookForm" action="processAddBook.php" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalTitle">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" name="title" required>
                    </div>
                    <!-- ISBN -->
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <!-- Author -->
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input class="form-control" id="author" name="author" required>
                    </div>
                    <!-- Publisher -->
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input class="form-control" id="publisher" name="publisher" required>
                    </div>
                    <!-- Year Published -->
                    <div class="form-group">
                        <label for="year_published">Year Published</label>
                        <input class="form-control" id="year_published" name="year_published" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input class="form-control" id="category" name="category" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>