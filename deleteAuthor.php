<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/System.php';
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/db.php';

class deleteAuthor {

    /**
     * Форма не вызывается, если удаление через js
     * @return string|void
     */
    public function authorEraser() {

        $tableMaker = new TableMaker;
        $db_updater = new db();

        $author_id = 0;
        $author_name = '';
        $page_title = 'Удаление автора';
        echo $tableMaker->makeHeader($page_title);

        if (isset($_GET["delete_author"])) {
            $author_id = $_GET["author_id"];
        }

        if (isset($_GET["author_id"])) {
            $author_id = $_GET["author_id"];
        }

        if (isset($_POST["delete"])) {
            If (isset($_POST['delete_author'])) {
                $author_id = $_POST["delete_author"];
                $db_updater->dbDeleteAuthor($author_id);
            }
            return header("Location: /");
        }

        return $this->deleteAuthorForm($author_id, $author_name);
    }


    /**
     * @param $author_id
     * @param $author_name
     * @return string
     */
    private function deleteAuthorForm($author_id, $author_name) {

        return '
            <div class="container">
            <a class="btn btn-info" href="/">Вернуться к списку</a>
                <form name="author" action="" method= "POST">
                    <div class="form-group">
                        <input id="author_id" type="hidden" class="form-control" name="author_id" value="' . $author_id . '" />
                        <label for="author_name" >Имя:</label>
                        <input disabled id="author_name" type="text" class="form-control" name="author_name" placeholder="' . $author_name . '" value = "' . $author_name . '" />
                    </div>
                    <button class="btn btn-danger" type="submit" name="delete">Удалить</button>
                    <a class="btn btn-dark" href="/">Отмена</a>
                </form>
            </div>';

    }

}
