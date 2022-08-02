$("#log_form").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        'let': login = $('input.login').val(),
        'let': password = $('input.password').val(),
        //send data
        method: "POST",
        url: "../../index.php",
        data: {
            login: login, password: password
        },
        success: function (data) {
            //в случае ошибки выводим ее на ui
            if (data.includes("error")) {
                console.log('catch error');
                $('.log_err').html("error, such user doesn\'t exists");
            }
            //при отсутствии ошибок редиректим на страницу контента
            if (!data.includes("error")) {
                $('input.login').val('');
                $('input.password').val('');
                window.location.href = 'content_page.php';
            }
        },
    })
});






