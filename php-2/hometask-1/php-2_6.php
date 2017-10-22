<?php

/**
 * 6. Объясните результаты в этом случае.
 *Дан код:
 * class A {
 * public function foo() {
 * static $x = 0;
 * echo ++$x;
 * }
 * }
 * class B extends A {
 * }
 * $a1 = new A;
 * $b1 = new B;
 * $a1->foo();
 * $b1->foo();
 * $a1->foo();
 * $b1->foo();
 *
 * Что он выведет на каждом шаге? Почему?
 */

class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x . '<br>';
    }
}

class B extends A
{
}

$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

echo '<hr><pre>
Если в конструктор не передаются параметры, то скобки можно не ставить.

Динамические методы в PHP существуют в контексте классов, а не объектов.
И только лишь в рантайме происходит подстановка "$this = текущий_объект".
</pre>';