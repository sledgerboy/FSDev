<?php
//error_reporting(E_ALL);

require_once __DIR__ . '/System.php';
require_once __DIR__ . '/data.php';



class TableMaker {


    var $title = 'FS dev';
    var $bye = "&copy; 2024";


    /**
     * Генератор хэдера
     * @param $title
     * @return string
     */
    public function makeHeader($title) {

        $fakeFileVer = rand(1,99);

        $html = '
        <!DOCTYPE html>
        <html>
            <head>
                <title> ' . $title . '</title>
                
                <meta charset="utf-8" />
                <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                <meta http-equiv="Pragma" content="no-cache" />
                <meta http-equiv="Expires" content="0" />
                
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link rel="stylesheet" href="/custom_style.css?ver='.$fakeFileVer.'">
                
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                
                <script src="/custom_scripts.js?ver='.$fakeFileVer.'"></script>
            </head>
        <body>
        <div class="header"><div class="container"><h1>'.$title.'</h1></div></div>
        
        <div class="faderclass">
            <div class="loading">Выполняется удаление...</div>
        </div>
        

               ';

        return $html;

    }


    /**
     * Формирование html-таблицы с книгами
     * @param $books_data
     * @return string
     */
    public function makeTableBooks($books_data) {
        
        $countIds = 1;
        $table_str = "<div class='container'>";
        $table_str .= "<h2>Список Книг</h2>";
        $table_str .= "<a class='btn btn-sm btn-success' href='/?action=edit_book'>Добавить книгу</a>";
        $table_str .= "<table class='table'>
            <tr>
                <th>Номер п/п</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Действия</th>
            </tr>";

        foreach($books_data as $book_data) {
            if(!empty($book_data['id'])){
                $book_author = $book_data['book_author'] ?: "<small class='text-muted'>не указан</small>";
                $buttonParams = '`' . $book_data["id"] . '`'. ',' . '`' . trim($book_data["book_name"]) . '`';
                $table_str .= "<tr>
                    <td>" . $countIds . "</td>
                    <td>" . $book_data['book_name'] . "</td>
                    <td>" . $book_author . "</td>
                    <td><a class='btn btn-sm btn-info' href = '?action=edit_book&book_id=".$book_data['id']."&book_name=".$book_data['book_name']."&author_id=".$book_data['book_author_id']." '>Редактировать</a>
                    <td><button class='btn btn-sm btn-danger' onclick='fsdev.bookDeleter(".$buttonParams.")'>Удалить</button></td>
                ";
                $table_str .= "</tr>";
                $countIds++;
            }
        }

        $table_str .= "</table></div>";

        return $table_str;
    }


    /**
     * Формирование html-таблицы с авторами
     * @param $authors_data
     * @return string
     */
    public function makeTableAuthors($authors_data) {

        $countIds = 1;
        $table_str = "<div class='container'>";
        $table_str .= "<h2>Список авторов</h2>";
        $table_str .= "<a class='btn btn-sm btn-success' href='/?action=edit_author'>Добавить автора</a>";

        $table_str .= "<table class='table'>
        <tr>
            <th>Номер п/п</th>
            <th>Автор</th>
            <th>Количество книг</th>
            <th></th>
        </tr>";

        foreach($authors_data as $author_data) {
            if (!empty($author_data['id'])) {
                $book_author = $author_data['author_name'] ?: "<small class='text-muted'>не указан</small>";
                $buttonParams = '`' . $author_data["id"] . '`'. ',' . '`' . trim($author_data["author_name"]) . '`';
                $table_str .= "<tr>
                <td>" . $countIds . "</td>
                <td>" . $book_author . "</td>
                <td>" . $author_data['author_books_count'] . "</td>
                <td><a class='btn btn-sm btn-info' href = '?action=edit_author&author_id=" . $author_data['id'] . "&author_name=" . $author_data['author_name'] . "'>Редактировать</a></td>
                <td><button class='btn btn-sm btn-danger' onclick='fsdev.authorDeleter(" . $buttonParams . ")'>Удалить</button></td>
                ";
                $table_str .= "</tr>";
                $countIds++;
            }
        }

        $table_str .= "</table></div>";

        return $table_str;

    }


    /**
     * Генератор футера
     * @param $bye
     * @return string
     */
    public function makeFooter($bye) {

        $html = '<hr>';
        $html .= '<div class="footer container">' . $bye . '</div>';
        $html .= '</body></html>';
        
        return $html;
    
    }

}