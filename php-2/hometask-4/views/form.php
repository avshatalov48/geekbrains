<h3><?=$auth->message?></h3>
<form action="" enctype="multipart/form-data" method = "get">
    Логин: <input name="login" type="text"/><br>
    Пароль: <input name="pass" type="password"/><br>
    <input value="Войти" type="submit"/><br>
    <input name="c" value="auth" type="hidden"/>
    <input name="a" value="login" type="hidden"/>
</form>