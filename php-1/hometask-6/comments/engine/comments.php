<?php
require_once ENGINE_DIR . "db.php";

function displayComments($id)
{
    /*Вывод комментария*/
    $feedback = queryOne("SELECT * FROM feedback WHERE image_id = {$id}");
    if ($feedback) {
        echo "<br><b>Пользователь: </b>" . $feedback["user_name"];
        echo "<br><b>Текст: </b>" . $feedback["text"];
    } else {
        echo "<br>Отзыв отсутствует! ";
    }
    echo "<br><a href='photo.php?id={$id}&addcom=form'>Добавить отзыв</a>" . "<hr>";
}

function addComments($id)
{
    $name = $_GET['name'];
    $text = $_GET['text'];
    executeQuery("INSERT INTO feedback (user_name, text, image_id) 
    VALUES('{$name}','{$text}', '{$id}')");

}

function formComments($id)
{
    echo "
    <form action='' method='get'>
    <input name='id' value='$id' type='hidden'/>
    <input name='addcom' value='view' type='hidden'/>
    <b>Пользователь:</b> <input name='name' type='text' required/><br>
    <b>Текст:</b><br><textarea name='text' id='' cols='30' rows='10' required></textarea><br><br>
    <input value='Отправить' type='submit'/>
    </form>
    ";
}