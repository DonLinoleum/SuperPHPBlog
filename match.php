<?php

$pattern = "~(2)(3)~";
$a = "23";
preg_match($pattern,$a,$matches);

var_dump($matches[2]);



?>
