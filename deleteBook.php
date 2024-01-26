<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/System.php';
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/db.php';

class deleteBook {

    /**
     * Форма не вызывается, если удаление через js
     * @return string|void
     */
    public function bookEraser() {

        $tableMaker = new TableMaker;
        $db_updater = new db();

        $book_id = 0;
        $book_name = '';
        $page_title = 'Удаление книги';

        echo $tableMaker->makeHeader($page_title);

        if (isset($_GET["book_id"])) {
            $book_id = $_GET["book_id"];
        }

        if (isset($_GET["book_name"])) {
            $book_name = $_GET["book_name"];
        }

        if (isset($_POST["delete"])) {
            if (isset($_POST["book_id"])) {
                $book_id = $_POST["book_id"];
                $db_updater->dbDeleteBook($book_id);
            }
            return header("Location: /");
        }

        return $this->deleteBookForm($book_id, $book_name);
    }

    /**
     * @param $book_id
     * @param $book_name
     * @return string
     */
    private function deleteBookForm($book_id, $book_name) {

        return '
            <div class="container">
                <a class="btn btn-info" href= "/">Вернуться к списку</a>
                <form name="book" action="" method="POST">
                    <div class="form-group">
                        <input id="book_id" type="hidden" class="form-control" name="book_id" value = "'.$book_id.'"/>
                        <label for="book_name">Название</label>
                        <input id="book_name" type="text" class="form-control" name="book_name" placeholder="'.$book_name.'" value="'.$book_name.'" />
                    </div>
                    <button class="btn btn-danger" type="submit" name="delete">Удалить</button>
                    <a class="btn btn-dark" href="/">Отмена</a>
                </form>
            </div >';

    }

}
