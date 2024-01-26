var fsdev = {

    /**
     * Удаление книги по id (confirm)
     * @param calcId
     */
    bookDeleter: function (book_id, book_name) {
        Swal.fire({
            title: "Удалить книгу " + book_name + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Да, удалить!"
        }).then((result) => {
            if (result.isConfirmed) {
                fsdev.deleteThisBook(book_id);
            }
        });
    },


    /**
     * Удаление книги по id
     * @param calcId
     * @param skipWarnings
     * @private
     */
    deleteThisBook: function (book_id) {

        $(".faderclass").css('display','block');

        $.ajax({
            url: '?delete_book_by_id=' + book_id,
            method: 'DELETE',
            data: {
                delete: true,
                delete_book_by_id: book_id
            },
            success: function(book_id) {
                $(".faderclass").css('display','none');
                Swal.fire({
                    title: "Удалено!",
                    text: "Книга удалена",
                    icon: "success"
                }).then(function () {
                    $(".faderclass").remove();
                    location.reload();
                });
            }
        });
    },


    /**
     * Удаление автора (confirm)
     * @param calcId
     */
    authorDeleter: function (author_id, author_name) {
        Swal.fire({
            title: "Удалить автора " + author_name + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Да, удалить!"
        }).then((result) => {
            if (result.isConfirmed) {
                fsdev.deleteThisAuthor(author_id);
            }
        });
    },


    /**
     * Удаление автора по id
     * @param calcId
     */
    deleteThisAuthor: function (author_id) {

        $(".faderclass").css('display','block');

        $.ajax({
            url: '?delete_author_by_id=' + author_id,
            method: 'DELETE',
            data: {
                delete: true,
                delete_author_by_id: author_id
            },
            success: function(author_id) {
                $(".faderclass").css('display','none');
                Swal.fire({
                    title: "Удалено!",
                    text: "Автор удален",
                    icon: "success"
                }).then(function () {
                    $(".faderclass").remove();
                    location.reload();
                });
            }
        });
    }

}
