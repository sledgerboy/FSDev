<?php


class db {


    /**
     * Добавление книги
     * @param $book_name
     * @param $author_id
     * @return bool|mysqli_result
     */
    public function dbAddBook($book_name, $author_id) {

        $sql = "INSERT INTO `fs_books` (`book_name`,`book_author`) VALUES('$book_name','$author_id')";

        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Редактирование книги
     * @param $book_id
     * @param $book_name
     * @param $author_id
     * @return bool|mysqli_result
     */
    public function dbEditBook($book_id, $book_name, $author_id) {

        $sql = "UPDATE `fs_books` 
                SET book_name = '$book_name', 
                    book_author = '$author_id' 
                WHERE id = '$book_id'";

        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Удаление книги
     * @param $book_id
     * @return bool|mysqli_result
     */
    public function dbDeleteBook($book_id) {

        $sql = "DELETE FROM `fs_books` 
                WHERE id = '$book_id'";
        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Добавление автора
     * @param $author_name
     * @return bool|mysqli_result
     */
    public function dbInsertAuthor($author_name) {

        $sql = "INSERT INTO `fs_authors` (`author_name`) VALUES('$author_name')";
        return (new System)->sqlConnect()->query($sql);

    }


    /**
     * Редактирование автора
     * @param $author_id
     * @param $author_name
     * @return bool|mysqli_result
     */
    public function dbUpdateAuthor($author_id, $author_name) {

        $sql = "UPDATE `fs_authors` SET `author_name` = '$author_name' WHERE id = '$author_id'";
        return (new System)->sqlConnect()->query($sql);
    }


    /**
     * Удаление автора
     * @param $author_id
     * @return bool|mysqli_result
     */
    public function dbDeleteAuthor($author_id) {

        $sql = "DELETE FROM `fs_authors` 
                WHERE id = '$author_id'";

        return (new System)->sqlConnect()->query($sql);

    }

}
