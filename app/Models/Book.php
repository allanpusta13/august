<?php

namespace App\Models;

use App\Model;

require_once __DIR__ . '/../Model.php';

class Book extends Model
{
    protected $table = 'books';

    public $id;
    public $title;
    public $isbn;
    public $author;
    public $publisher;
    public $year_published;
    public $category;

    public function __construct() {
        parent::__construct(table:$this->table);
    }
}
