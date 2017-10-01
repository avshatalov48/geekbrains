<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Alexander Shatalov > PHP 1 > Lesson 3 > Exercise 6 > Menu</title>
    <link rel="stylesheet" id="papercuts-icons-css"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css?ver=4.8.2" type="text/css"
          media="all">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=latin,cyrillic);

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f9fe;
            font-family: 'Open Sans', sans-serif;
        }

        nav {
            background: white;
            box-shadow: 0 2px 0 0 #ECF1F2;
            border-top: 1px solid #ECF1F2;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            display: block;
            transition: .3s linear;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .topmenu > li {
            display: inline-block;
            position: relative;
            margin-right: -4px;
            border-left: 1px solid #ECF1F2;
        }

        .topmenu > li:last-child {
            border-right: 1px solid #ECF1F2;
        }

        .topmenu > li > a {
            font-weight: bold;
            padding: 20px 30px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1c1c1c;
        }

        .active:after, .submenu-link:after {
            content: "\f107";
            font-family: "FontAwesome";
            color: inherit;
            margin-left: 10px;
        }

        .topmenu .active, .topmenu > li > a:hover, .submenu li a:hover {
            color: #ddbe86;
        }

        .submenu {
            position: absolute;
            left: -1px;
            z-index: 5;
            width: 240px;
            border-bottom: 1px solid #ECF1F2;
            visibility: hidden;
            opacity: 0;
            transform: translateY(10px);
            transition: .3s ease-in-out;
        }

        .submenu li {
            position: relative;
        }

        .submenu a {
            background: white;
            border-top: 1px solid #ECF1F2;
            border-right: 1px solid #ECF1F2;
            border-left: 1px solid #ECF1F2;
            color: #1c1c1c;
            text-align: left;
            font-size: 14px;
            letter-spacing: 1px;
            padding: 10px 20px;
        }

        .submenu .submenu {
            position: absolute;
            top: 0;
            left: calc(100% - 1px);
            left: -webkit-calc(100% - 1px);
        }

        nav li:hover > .submenu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0px);
        }
    </style>
</head>

<body>

<!--<nav>
  <ul class="topmenu">
    <li><a href="" class="active">Главная</a>
      <ul class="submenu">
        <li><a href="">меню второго уровня</a></li>
        <li><a href="" class="submenu-link">меню второго уровня</a>
          <ul class="submenu">
            <li><a href="">меню третьего уровня</a></li>
            <li><a href="">меню третьего уровня</a></li>
            <li><a href="">меню третьего уровня</a></li>
          </ul>
        </li>
        <li><a href="">меню второго уровня</a></li>
      </ul>
    </li>
    <li><a href="">Компания</a></li>
    <li><a href="">Блог</a></li>
    <li><a href="">Контакты</a></li>
  </ul>
</nav>-->

<nav>

    <?php

    /*
     * 6. В имеющемся шаблоне сайта заменить статичное меню (ul - li) на генерируемое через PHP.
     * Необходимо представить пункты меню как элементы массива и вывести их циклом.
     * Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.
     */

    $menu = [
        "Главная" => ["Пункт 1", "Пункт 2",
            "Подменю" => ["Пункт 1", "Пункт 2", "Пункт 3", "Пункт 4", "Пункт 5"]
        ],
        "Компания" => ["Пункт 1", "Пункт 2", "Пункт 3", "Пункт 4", "Пункт 5"],
        "Блог" => ["Пункт 1", "Пункт 2", "Пункт 3", "Пункт 4"],
        "Контакты"
    ];

    /*    echo "<pre>";
        var_dump($menu);
        echo "</pre>";*/

    echo "<ul class=\"topmenu\">";
    foreach ($menu as $item => $itemName) {
        /*        echo "<b>$state:</b><br>";
                foreach ($towns as $key => $value) {
                    $comma = ($key < count($towns) - 1) ? ", " : "";
                    echo "$value" . $comma;
                }*/
//        echo "$itemName<br>";
        if (is_array($itemName)) {
            echo "<li><a href=\"\">$item</a>";
            echo "<ul class=\"submenu\">";
            foreach ($itemName as $itemMenu => $itemNameMenu) {
                echo "<li><a href=\"\">$itemMenu</a></li>";
            }
            echo "</ul>";
            echo "</li>";
        } else {
            echo "<li><a href=\"\">$itemName</a></li>";
        }
    }
    echo "</ul>";

    ?>

    <!--    <ul class="topmenu">
            <li><a href="" class="active">Главная</a>
                <ul class="submenu">
                    <li><a href="">меню второго уровня</a></li>
                    <li><a href="" class="submenu-link">меню второго уровня</a>
                        <ul class="submenu">
                            <li><a href="">меню третьего уровня</a></li>
                            <li><a href="">меню третьего уровня</a></li>
                            <li><a href="">меню третьего уровня</a></li>
                        </ul>
                    </li>
                    <li><a href="">меню второго уровня</a></li>
                </ul>
            </li>
            <li><a href="">Компания</a></li>
            <li><a href="">Блог</a></li>
            <li><a href="">Контакты</a></li>
        </ul>-->
</nav>

</body>

</html>