$("#reg_form").on('submit', function (e) {
    e.preventDefault();
    document.querySelector('.err').value = '100';
    let valid = $("#reg_form").valid();
    if (valid) {
        $.ajax({
            'let': login = $('input.login').val(),
            'let': password = $('input.password').val(),
            'let': confirm_password = $('input.confirm_password').val(),
            'let': email = $('input.email').val(),
            'let': name = $('input.name').val(),
            //send data
            method: "POST",
            url: "../../index.php",
            data: {
                login: login, password: password,
                email: email, name: name
            },
            success: function (data) {
                //отображение ошибки, если логин не уникален
                if (data.includes("login")) {
                    $('.err').html("login must be unique");
                }
                //отображение ошибки, если email не уникален
                if (data.includes("email")) {
                    $('.err').html("email must be unique");
                }
                if (data.includes("space_detect")) {
                    $('.err').html("error, spaces were found in the received form");
                }
                //при успешной регистрации отображаем сообщение и затираем все поля
                if (data.includes("success")) {
                    $('input.login').val('');
                    $('input.password').val('');
                    $('input.confirm_password').val('');
                    $('input.email').val('');
                    $('input.name').val('');
                    $('.err').html('user has been register, please return to main page');
                }
            },
        })


    }
});
