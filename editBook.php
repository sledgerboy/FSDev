<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/System.php';
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/db.php';

class editBook {

    /**
     * @return string|void
     */
    public function bookEditor() {

        $tableMaker = new TableMaker;
        $db_updater = new db();
        $APIcontroller = new APIController();

        $book_id = 0;
        $author_id = 0;
        $book_name = '';
        $page_title = 'Редактирование книги';

        echo $tableMaker->makeHeader($page_title);

        if (isset($_GET["book_id"])) {
            $book_id = $_GET["book_id"];
        }

        if (isset($_GET["book_name"])) {
            $book_name = $_GET["book_name"];
        }

        if (isset($_POST["book_name"])) {
            $book_name = $_POST["book_name"];
        }

        if (isset($_GET["author_id"])) {
            $author_id = $_GET["author_id"];
        }

        if (isset($_POST["author_name"])) {
            $author_id = $_POST["author_name"];
        }

        if (isset($_POST["send"])) {

            if (isset($_POST["book_id"])) {
                $book_id = $_POST["book_id"];
            }

            if ($book_id != 0) {
                $db_updater->dbEditBook($book_id, $book_name, $author_id);
            } else {
                $db_updater->dbAddBook($book_name, $author_id);
            }

            return header("Location: /");

        }

        $authorslist = $APIcontroller->dbGetAuthorsDropdown();

        return $this->editBookForm($book_id, $book_name, $authorslist, $author_id);

    }


    /**
     * @param $book_id
     * @param $book_name
     * @param $authorslist
     * @param $author_id
     * @return string
     */
    private function editBookForm($book_id, $book_name, $authorslist, $author_id) {

        $bookForm = '
            <div class="container">
                <a class="btn btn-info" href="/">Вернуться к списку</a>
                <form name="book" action="" method="POST">
                    <input id="book_id" type="hidden" class="form-control" name="book_id" value="'.$book_id.'"/>
                    <div class="form-group">
                        <label for="book_name">Название</label>
                        <input id="book_name" type="text" class="form-control" name="book_name" placeholder="'.$book_name.'" value="'.$book_name.'"/>
                    </div>
                    <div class="form-group">
                        <label for="author_name">Автор</label>
                        <select name="author_name" class="form-control" id="author_name">';

                                foreach ($authorslist as $author) {
                                     $bookForm .= "<option value=".$author['id']."";

                                     if ($author_id === $author["id"]) {
                                         $bookForm .= ' selected';
                                     }

                                     $bookForm .= '>'.$author['author_name'].'</option>';
                                }

                                $bookForm .= '</select>

                    </div>
                    <button class="btn btn-success" type="submit" name="send">Сохранить</button>
                    <a class="btn btn-dark" href="/">Отмена</a>
                </form>
            </div>';

        return $bookForm;
    }

}
