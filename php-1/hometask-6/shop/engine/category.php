<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";

function selectCategory()
{
    $html = '<select name="category_id"><option value="">Выберите категорию</option>';
    $categories = queryAll("SELECT * FROM category");
    foreach ($categories as $category) {
        $html .= '<option value="' .$category["id"] . '">' .$category["name"] . '</option>';
    }
    $html .= '</select>';
    return $html;
}