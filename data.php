<?php
require_once __DIR__ . '/System.php';

class data {

    /**
     * Получение данных книг
     * @return bool|mysqli_result
     */
    public function booksData() {

        $sql = "SELECT 
                fsb.id, 
                fsb.book_name, 
                fsb.book_author,
                fsa.id AS author_id,
                fsa.author_name 
                FROM `fs_books` AS fsb
                LEFT JOIN `fs_authors` AS fsa ON fsb.book_author = fsa.id
                ORDER BY fsb.book_name ASC
        ";

        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Получение данных авторов
     * @return bool|mysqli_result
     */
    public function authorsData() {

        $sql = "SELECT 
                 fsa.id,
                 fsa.author_name,
                 COUNT(fsb.book_author) AS author_books_count
                 FROM `fs_authors` AS fsa
                 LEFT JOIN `fs_books` AS fsb 
                     ON fsb.book_author = fsa.id
                 GROUP BY fsa.id
                 ORDER BY author_books_count DESC
        ";

        return (new System)->sqlConnect()->query($sql);

    }

}