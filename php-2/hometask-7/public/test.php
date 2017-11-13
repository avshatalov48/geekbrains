<?php

class Rectangle
{
    protected $a;
    protected $b;

    /**
     * @return mixed
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * @param mixed $a
     */
    public function setA($a)
    {
        $this->a = $a;
    }

    /**
     * @return mixed
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param mixed $b
     */
    public function setB($b)
    {
        $this->b = $b;
    }
}

class Square
{
    /**
     * @param mixed $a
     */
    public function setA($a)
    {
        $this->a = $a;
        $this->b = $a;
    }

    /**
     * @param mixed $b
     */
    public function setB($b)
    {
        $this->b = $b;
        $this->a = $b;
    }

}

function foo(Rectangle $r)
{
    return $r->getA() * $r->getB();
}


$figure = new Square();
$figure->setA(5);
$figure->setB(4);
echo foo($figure);