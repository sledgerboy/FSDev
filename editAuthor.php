<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/System.php';
require_once __DIR__ . '/db.php';

class editAuthor {

    /**
     * @return string|void
     */
    public function authorEditor() {

        $tableMaker = new TableMaker;
        $db_updater = new db();

        $author_id = 0;
        $author_name = '';
        $page_title = 'Редактирование автора';

        echo $tableMaker->makeHeader($page_title);

        if (isset($_GET["author_name"])) {
            $author_name = $_GET["author_name"];
        }

        if (isset($_GET["author_id"])) {
            $author_id = $_GET["author_id"];
        }

        if (isset($_POST["send"])) {

            if (isset($_POST["author_id"])) {
                $author_id = $_POST["author_id"];
            }

            if (isset($_POST["author_name"])) {
                $author_name = $_POST["author_name"];
            }

            if ($author_id > 0) {
                $db_updater->dbUpdateAuthor($author_id, $author_name);
            } else {
                $db_updater->dbInsertAuthor($author_name);
            }

            return header("Location: /");

        }

        return $this->editAuthorForm($author_id, $author_name);
    }

    /**
     * @param $author_id
     * @param $author_name
     * @return string
     */
    private function editAuthorForm($author_id, $author_name) {

        $authorForm = '
            <div class="container">
                <a class="btn btn-info" href="/">Вернуться к списку</a>
                <form name="author" action="" method = "POST">
                    <input id="author_id" type="hidden" class="form-control" name="author_id" value="'.$author_id.'" />
                    <div class="form-group">
                        <label for="author_name">Имя автора:</label>
                        <input id="author_name" type="text" class="form-control" name="author_name" placeholder="'.$author_name.'" value = "'.$author_name.'" />
                    </div>
                    <button class="btn btn-success" type="submit" name="send">Сохранить</button>
                    <a class="btn btn-dark" href="/"> Отмена</a>
                </form>
            </div>';

        return $authorForm;

    }

}
