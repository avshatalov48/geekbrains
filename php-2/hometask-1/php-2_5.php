<?php

/**
 * 5. Дан код:
 *
 * class A {
 * public function foo() {
 * static $x = 0;
 * echo ++$x;
 * }
 * }
 * $a1 = new A();
 * $a2 = new A();
 * $a1->foo();
 * $a2->foo();
 * $a1->foo();
 * $a2->foo();
 * Что он выведет на каждом шаге? Почему?
 * Немного изменим п.5
 *
 * class A {
 * public function foo() {
 * static $x = 0;
 * echo ++$x;
 * }
 * }
 * class B extends A {
 * }
 * $a1 = new A();
 * $b1 = new B();
 * $a1->foo();
 * $b1->foo();
 * $a1->foo();
 * $b1->foo();
 */
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x . '<br>';
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();


echo '<hr>';


class C
{
    public function foo()
    {
        static $x = 0;
        echo ++$x . '<br>';
    }
}

class B extends C
{
}

$c1 = new C();
$b1 = new B();
$c1->foo();
$b1->foo();
$c1->foo();
$b1->foo();

echo '<hr><pre>
Динамические методы в PHP «не размножаются». Даже если у нас будет сто объектов этого класса,
метод будет существовать лишь в одном экземпляре, просто при каждом вызове в него будет пробрасываться разный $this.

Наследование класса (и метода) приводит к тому, что всё-таки создается новый метод.

Вывод: динамические методы в PHP существуют в контексте классов, а не объектов.
И только лишь в рантайме происходит подстановка "$this = текущий_объект".

Источник: <a href="https://habrahabr.ru/post/259627/">Готовимся к собеседованию по PHP: ключевое слово "static"</a>
</pre>';