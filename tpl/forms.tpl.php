<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <form action="" id="loginForm" style="display: block">
                <p id="infoLForm" class="text-danger"></p>
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="login" class="form-control">
                    <small id="loginLForm" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control">
                    <small id="passwordLForm" class="form-text text-danger"></small>
                </div>
                <input type="button" value="Вход" id="sendLoginForm" class="btn btn-primary">
            </form>
            <p></p>
            <form id="registrationForm" style="display: block">
                <h2>Регистрация</h2>
                <p id="info" class="text-danger"></p>
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="login" class="form-control">
                    <small id="login" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control">
                    <small id="password" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Подтверждение пароля</label>
                    <input type="password" name="confirmPassword" class="form-control">
                    <small id="confirmPassword" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                    <small id="email" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" class="form-control">
                    <small id="name" class="form-text text-danger"></small>
                </div>
                <input type="button" value="Регистрация" id="sendRegForm" class="btn btn-primary">
            </form>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>