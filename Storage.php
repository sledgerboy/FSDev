<?php
require_once __DIR__ . '/System.php';

class Storage {

    /**
     * Сборка выборочных данных из массива по книгам
     * *для таблицы
     * @return array
     */
    public function collectBooksData() {

        $data = (new data)->booksData();
        $books_data = [];
        $countBooks = 1;

        foreach($data as $row) {

            $book_id = $row["id"];
            $book_name = $row["book_name"];
            $book_author = $row["author_name"];
            $book_author_id = $row["author_id"];
            $books_data[$book_id]["id"] = $book_id;
            $books_data[$book_id]["book_name"] = $book_name;
            $books_data[$book_id]["book_author_id"] = $book_author_id;
            $books_data[$book_id]["book_author"] = $book_author;
            $countBooks ++;

        }

        $books_data['count_books'] = $countBooks;

        return $books_data;

    }


    /**
     * Сборка выборочных данных из массива по авторам
     * *для таблицы
     * @return array
     */
    public function collectAuthorsData() {

        $data = (new data)->authorsData();
        $authors_data = [];
        $countAuthors = 1;

        foreach($data as $row) {
            $author_id = $row["id"];
            $authors_data[$author_id]['id'] = $row["id"];
            $authors_data[$author_id]['author_name'] = $row["author_name"];
            $authors_data[$author_id]['author_books_count'] = $row["author_books_count"];
            $countAuthors ++;
        }

        $authors_data['count_authors'] = $countAuthors;

        return $authors_data;

    }

}