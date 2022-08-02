// login (unique)    [валидация : минимум 6 символов ]
// password          [валидация : минимум 6 символов , обязательно должны состоять из цифр и букв]
// confirm_password
// email (unique)    [валидация : email]
// name              [валидация : 2 символа , только буквы]
jQuery.validator.addMethod("lettersOnly", function (value, element) {
    return this.optional(element) || /^[а-яА-ЯёЁa-zA-Z]+$/i.test(value);
}, " поле должно состоять только из букв");

jQuery.validator.addMethod("letterAndCharactersOnly", function (value, element) {
    return this.optional(element) || /^(?=.*[0-9])(?=.*[а-яА-ЯёЁa-zA-Z])([а-яА-ЯёЁa-zA-Z0-9]+)$/i.test(value);
}, " поле должно состоять только из цифр и букв");

jQuery.validator.addMethod("noSpace", function(value) {
    return value.indexOf(" ") < 0 && value != "";
}, " логин не может содержать пробелы");

$(document).ready(function () {
    $("#reg_form").validate({
        rules: {
            login: {
                noSpace:false,
                required: true,
                minlength: 6,
            },
            password: {
                required: true,
                minlength: 6,
                letterAndCharactersOnly: true,
            },
            confirm_password: {
                required: true,
                equalTo: ".password",
            },
            email: {
                required: true,
                minlength: 6,
                email: true,
            },
            name: {
                required: true,
                maxlength: 2,
                lettersOnly: true
            },
        },
        messages: {
            login: {
                required: " поле обязательно для заполнения",
                minlength: " логин должен быть минимум 6 символов",
            },
            password: {
                required: " поле обязательно для заполнения",
                minlength: " пароль должен быть минимум 6 символов",

            },
            confirm_password: {
                required: " поле обязательно для заполнения",
                equalTo: " значение в поле должно быть равно паролю",

            },
            email: {
                required: " поле обязательно для заполнения",
                email: " введите корректный email",
            },
            name: {
                required: " поле обязательно для заполнения",
                maxlength: " не более 2х символов"
            },
        }
    });
});
