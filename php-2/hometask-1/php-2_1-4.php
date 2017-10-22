<?php

/**
 * 1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов
 * продукт, ценник, посылка и т.п.
 *
 * 2. Описать свойства класса из п.1 (состояние).
 *
 * 3. Описать поведение класса из п.1 (методы).
 *
 * 4. Придумать наследников класса из п.1. Чем они будут отличаться?
 */
class Product
{
    public $id;
    public $article;
    public $category;
    public $title;
    public $description;
    public $size;
    public $weight;
    public $price;
    public $guarantee;
    public $country;
    public $count;

    public function __construct($article, $category, $title, $description, $size, $weight, $price, $guarantee, $country, $count)
    {
        $this->article = $article;
        $this->id_category = $category;
        $this->title = $title;
        $this->description = $description;
        $this->size = $size;
        $this->weight = $weight;
        $this->price = $price;
        $this->guarantee = $guarantee;
        $this->country = $country;
        $this->count = $count;
    }

    public function view()
    {
        echo "
            <b>Артикул:</b> $this->article<br>
            <b>Категория:</b> $this->id_category<br>
            <b>Наименование:</b> $this->title<br>
            <b>Описание:</b> $this->description<br>
            <b>Размер:</b> $this->size<br>
            <b>Вес:</b> $this->weight кг<br>
            <b>Цена:</b> $this->price руб.<br>
            <b>Гарантия:</b> $this->guarantee мес.<br>
            <b>Страна-производитель:</b> $this->country<br>
            <b>Количество на складе:</b> $this->count<br>
        ";
    }

    // Списание товара со склада
    public function removeFromStock($number)
    {
        echo "<hr>";
        if (($this->count - $number) < 0) {
            echo "<b>Недостаточное количество товара на складе для списания!</b><br>";
        } else {
            $this->count -= $number;
            echo "<b>Списание товара $this->title в количестве $number выполнено успешно!</b><br>";
        }
        echo "<b>Остаток на складе:</b> $this->count<br>";
    }

}

$good1 = new Product("#326166", "Неттопы", "Lenovo ThinkCentre M710q",
    "ПЭВМ Lenovo ThinkCentre M710q <10MRS04600> Intel Core i3-7100T 4ГБ RAM 128Гб SSD DOS",
    "49.99 x 27.84 x 15.25 см", 3.55, 28087, 12, "Китай", "7");
$good1->view();
$good1->removeFromStock(10);
$good1->removeFromStock(2);

var_dump(good1);