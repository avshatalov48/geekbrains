<?php

class MathClass
{
    public function factorial($n)
    {
        if ($n == 0)
            return 1;
        else
            return $n * $this->factorial($n - 1);
    }
}