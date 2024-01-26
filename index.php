<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/Storage.php';
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/editBook.php';
require_once __DIR__ . '/editAuthor.php';
require_once __DIR__ . '/deleteBook.php';
require_once __DIR__ . '/deleteAuthor.php';

class index {

    /**
     * @return bool|mysqli_result|string|void
     */
    public static function index_table() {

        $tableMaker = new TableMaker;
        $storage = new Storage();
        $APIController = new APIController();
        $books_data = $storage->collectBooksData();
        $authors_data  = $storage->collectAuthorsData();

        // add or edit book
        if((isset($_GET['action'])) && ($_GET['action'] == 'edit_book')) {
            $bookEdit = new editBook();
            return $bookEdit->bookEditor();
        }

        // add or edit author
        if((isset($_GET['action'])) && ($_GET['action'] == 'edit_author')) {
            $authorEdit = new editAuthor();
            return $authorEdit->authorEditor();
        }

        // delete book
        if((isset($_GET['action'])) && ($_GET['action'] == 'delete_book')) {
            $bookDelete = new deleteBook();
            return $bookDelete->bookEraser();
        }

        // delete author
        if((isset($_GET['action'])) && ($_GET['action'] == 'delete_author')) {
                $authorDelete = new deleteAuthor();
                return $authorDelete->authorEraser();
        }

        // api
        if (isset($_GET['get_books_by_author'])) {
            $author_needed = $_GET['get_books_by_author'];
            return $APIController->dbGetBooksByAuthor($author_needed);
        }

        // api
        if (isset($_GET['get_book_by_id'])) {
            $book_id_needed = $_GET['get_book_by_id'];
            return $APIController->dbGetBookById($book_id_needed);
        }

        // api
        if (isset($_GET['delete_book_by_id'])) {
            $book_id_needed = $_GET['delete_book_by_id'];
            return $APIController->dbDeleteBookById($book_id_needed);
        }

        // api
        if (isset($_GET['delete_author_by_id'])) {
            $author_id_needed = $_GET['delete_author_by_id'];
            return $APIController->dbDeleteAuthorById($author_id_needed);
        }

        // api
        if (isset($_POST['update']) && ($_POST['update'] == 'yes')) {

            $book_id_needed = 0;
            $author_id = 0;
            $book_name = '';

            if (isset($_POST['book_id'])){
                $book_id_needed = $_POST['book_id'];
            }

            if (isset($_POST['author_name'])){
                $author_name = $_POST['author_name'];
                $checker = $APIController->dbCheckAuthorByName($author_name);
                if ($checker != "not found") {
                    $author_id = $checker;
                }
            }

            if (isset($_POST['book_name'])){
                $book_name = $_POST['book_name'];
            }

            return $APIController->dbUpdateBookById($book_id_needed, $book_name, $author_id);

        }

        // main table construction
        echo $tableMaker->makeHeader($tableMaker->title);
        echo $tableMaker->makeTableBooks($books_data);
        echo $tableMaker->makeTableAuthors($authors_data);
        echo $tableMaker->makeFooter($tableMaker->bye);


        
    }

}

echo index::index_table();