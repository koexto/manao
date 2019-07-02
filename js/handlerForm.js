$(document).ready(function () {

    //обработка формы регистрации.
    $('#sendRegForm').click(function () {

        //очищаем сообщения об ошибках перед выводом новых
        var alertIds = ['info', 'login', 'password', 'confirmPassword', 'email', 'name'];
        alertIds.forEach(function (item) {
            $('#' + item).text('');
        });

        var data = new FormData($('#registrationForm').get(0));

        $.ajax({
            url: 'registration.php',
            processData: false,
            contentType: false,
            data: data,
            type: 'POST',
            success: function (response) {
                if (response.success){
                    alert('Регистрация завершена. Вы можете войти, используя логин и пароль');
                    location.reload();
                }
                response.errors.forEach(function (item){
                    var id = Object.keys(item);
                    var error = item[id[0]];
                    $('#' + id[0]).text(error);
                });
            },
            error: function () {
                alert('Регистрация неудачна. Свяжитесь с администрацией сайта.');
                location.reload();
            }
        });
    });

    //обработка формы входа
    $('#sendLoginForm').click(function (){

        var data = new FormData($('#loginForm').get(0));

        //очищаем сообщения об ошибках перед выводом новых
        $('#loginLForm').text('');
        $('#passwordLForm').text('');
        $('#infoLForm').text('');

        $.ajax({
            url: 'login.php',
            processData: false,
            contentType: false,
            data: data,
            type: 'post',
            success: function (response){
                if (response.success){
                    location.reload();
                }
                response.errors.forEach(function (item){
                    var id = Object.keys(item);
                    var error = item[id[0]];
                    $('#' + id[0] + 'LForm').text(error);
                });
            },
            error: function (){
                alert('Вход неудачен. Свяжитесь с администрацией сайта.');
                location.reload();
            }
        });
            
    });
});
