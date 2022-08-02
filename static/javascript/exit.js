$("#exit_form").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        //send data
        method: "POST",
        url: "../../index.php",
        data: {
            exit: 'exit'
        },
        //при клике на exit редиректим на стартовую страницу
        success: function (data) {
            window.location.href = 'start_page.php';
        },
    })
});
