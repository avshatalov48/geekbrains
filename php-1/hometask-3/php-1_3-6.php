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

    // Пункт меню - Название, ссылка, класс, подменю
    $menu = [
        ["title" => "Главная", "href" => "#", "class" => "active", "submenu" => true, "items" =>
            [
                ["title" => "Главная 1", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Главная 2", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Главная Подменю", "href" => "#", "class" => "", "submenu" => true, "items" =>
                    [
                        ["title" => "Пункт 1", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 2", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 3", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Главная Подменю", "href" => "#", "class" => "", "submenu" => true, "items" =>
                            [
                                ["title" => "Пункт 1", "href" => "#", "class" => "", "submenu" => false],
                                ["title" => "Пункт 2", "href" => "#", "class" => "", "submenu" => false],
                                ["title" => "Пункт 3", "href" => "#", "class" => "", "submenu" => false],
                                ["title" => "Главная Подменю", "href" => "#", "class" => "", "submenu" => true, "items" =>
                                    [
                                        ["title" => "Пункт 1", "href" => "#", "class" => "", "submenu" => false],
                                        ["title" => "Пункт 2", "href" => "#", "class" => "", "submenu" => false],
                                        ["title" => "Пункт 3", "href" => "#", "class" => "", "submenu" => false],
                                        ["title" => "Пункт 4", "href" => "#", "class" => "", "submenu" => false]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        ["title" => "Компания", "href" => "#", "class" => "", "submenu" => true, "items" =>
            [
                ["title" => "Компания 1", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Компания 2", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Компания 3", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Компания 4 Подменю", "href" => "#", "class" => "", "submenu" => true, "items" =>
                    [
                        ["title" => "Пункт 1", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 2", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 3", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 4", "href" => "#", "class" => "", "submenu" => false]
                    ]
                ]
            ]
        ],
        ["title" => "Блог", "href" => "#", "class" => "", "submenu" => true, "items" =>
            [
                ["title" => "Блог 1", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Блог 2", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Блог 3", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Блог 4", "href" => "#", "class" => "", "submenu" => false],
                ["title" => "Блог 5 Подменю", "href" => "#", "class" => "", "submenu" => true, "items" =>
                    [
                        ["title" => "Пункт 1", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 2", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 3", "href" => "#", "class" => "", "submenu" => false],
                        ["title" => "Пункт 4", "href" => "#", "class" => "", "submenu" => false]
                    ]
                ]
            ]
        ],
        ["title" => "Контакты", "href" => "#", "class" => "", "submenu" => false]
    ];

    function vardump($array)
    {
        echo "<pre>";
        var_dump($array);
        echo "</pre><hr>";
    }

    function menuItem($array)
    {
        echo '<li><a href="' . $array['href'] . '" class="' . $array['class'] . '">' . $array['title'] . '</a>';
    }

    /*    function submenuCreate($array, $class)
        {
            menuItem($array);
            echo '<ul class="' . $class . '">';
            foreach ($array['items'] as $keyMenu => $itemMenu) {
                if ($itemMenu['submenu'] == true) {
                    submenuCreate($itemMenu, "submenu");
                } else {
                    menuItem($itemMenu);
                    echo '</li>';
                }
            }
            echo '</ul></li>';
        }*/

    function menuCreate($array, $class = "topmenu")
    {
//        if ($class=="submenu") menuItem($array);
        echo '<ul class="' . $class . '">';
        foreach ($array as $keyMenu => $itemMenu) {
            if ($itemMenu['submenu'] == true) {
                menuItem($itemMenu);
                menuCreate($itemMenu['items'], "submenu");
//                echo '</li>';
            } else {
                menuItem($itemMenu);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    menuCreate($menu);

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