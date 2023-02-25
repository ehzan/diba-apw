<?php

include_once '../Input.class.php';
include_once 'Solve.class.php';

$day = 5;

$stacker = new Solve(Input::content($day));
$stacker2 = new Solve(Input::content($day));

// part 1:
echo $stacker->calculate() . PHP_EOL;
// part 2:
echo $stacker2->calculate(true) . PHP_EOL;
