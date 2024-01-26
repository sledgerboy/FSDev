<?php
require_once __DIR__ . '/System.php';
require_once __DIR__ . '/db.php';

class APIController {

    /**
     * Получение списка авторов для селекта
     * @return bool|mysqli_result
     */
    public function dbGetAuthorsDropdown() {

        $sql = "SELECT
                fsa.id, 
                fsa.author_name 
                FROM `fs_authors` AS fsa
                ORDER BY fsa.author_name ASC
        ";

        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Получение json - книги по автору
     * @return bool|mysqli_result
     */
    public function dbGetBooksByAuthor($author_needed) {

        $author_id = "SELECT
                id
                FROM `fs_authors`
                WHERE author_name LIKE '%$author_needed%'
        ";

        $author_id_get = (new System)->sqlConnect()->query($author_id);
        $result = mysqli_fetch_array($author_id_get);
        $author_id_value = $result['id'];

        $author_books = "SELECT
                id,
                book_name
                FROM `fs_books`
                WHERE book_author = '$author_id_value'
        ";

        $author_books_get = (new System)->sqlConnect()->query($author_books);
        $result = mysqli_fetch_array($author_books_get);

        return json_encode($result, JSON_UNESCAPED_UNICODE);

    }


    /**
     * Получение json - книги по id
     * @return bool|mysqli_result
     */
    public function dbGetBookById($book_id_needed) {

        $book = "SELECT
                fsb.book_name,
                fsa.author_name
                FROM `fs_books` AS fsb
                    LEFT JOIN `fs_authors` AS fsa ON fsb.book_author = fsa.id
                WHERE fsb.id = '$book_id_needed'
        ";

        $book_info = (new System)->sqlConnect()->query($book);
        $result = mysqli_fetch_array($book_info);

        return json_encode($result, JSON_UNESCAPED_UNICODE);

    }


    /**
     * Получение id автора по имени
     * @param $author_name
     * @return array|false|null
     */
    public function dbCheckAuthorByName($author_name) {

        $author_id = "SELECT
                id
                FROM `fs_authors`
                WHERE author_name LIKE '%$author_name%'
        ";

        $author_info = (new System)->sqlConnect()->query($author_id);
        $result = mysqli_fetch_array($author_info);

        if (!$result) {
            return "author not found";
        }

        return $result['id'];

    }


    /**
     * Получение json - удаление книги по id
     * @return bool|mysqli_result
     */
    public function dbDeleteBookById($book_id_needed) {

            $db_updater = new db();
            $db_updater->dbDeleteBook($book_id_needed);

            return json_encode(array(
                'status'       => 'success',
            ));
    }


    /**
     * Получение json - удаление автора по id
     * @return bool|mysqli_result
     */
    public function dbDeleteAuthorById($book_id_needed) {

        $db_updater = new db();
        $db_updater->dbDeleteAuthor($book_id_needed);

        return json_encode(array(
            'status'       => 'success',
        ));
    }


    /**
     * Получение json - обновление данных книги
     * @return bool|mysqli_result
     */
    public function dbAddAuthor($author_name) {

        $db_updater = new db();
        $db_updater->dbInsertAuthor($author_name);

        return json_encode(array(
            'status'       => 'success',
        ));
    }


    /**
     * Получение json - обновление данных книги
     * @return bool|mysqli_result
     */
    public function dbUpdateBookById($book_id_needed, $book_name, $author_id) {

        $db_updater = new db();
        $db_updater->dbEditBook($book_id_needed, $book_name, $author_id);

        return json_encode(array(
            'status'       => 'success',
        ));
    }

}
