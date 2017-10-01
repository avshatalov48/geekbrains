<?php
/**
 * Skipping optional parameters for functions
 * https://stackoverflow.com/questions/1066625/how-would-i-skip-optional-arguments-in-a-function-call
 * https://wiki.php.net/rfc/skipparams
 */

function test($a = 7, $b = 5)
{
    echo "$a, $b<br>";
}

test(); // 7, 5

test(3, 4); // 3, 4

test(2); // 2, 5

test(null, 1); // , 1

test('', 2); // , 2

//test(, 1); // Parse error: syntax error, unexpected ','