<?php
include 'file-handle.php';

function puzzle7($input_file)
{
    $data = trim(read_file($input_file));
    $pairs = explode("\n", $data);
    $count = 0;
    foreach ($pairs as $pair) {
        [$a1, $a2, $b1, $b2] = preg_split('/-|,/', $pair);  // a1-a2,b1-b2
        $count += ($a1 <= $b1 && $b2 <= $a2) || ($b1 <= $a1 && $a2 <= $b2);
    }
    return $count;
}

function puzzle8($input_file)
{
    $data = trim(read_file($input_file));
    $pairs = explode("\n", $data);
    $count = 0;
    foreach ($pairs as $pair) {
        [$a1, $a2, $b1, $b2] = preg_split('/-|,/', $pair);
        $count += ($a1 <= $b1 && $b1 <= $a2) || ($b1 <= $a1 && $a1 <= $b2);
    }
    return $count;
}


echo 'Day #4, part one: ' . puzzle7('./input/day4.txt') . PHP_EOL;
echo 'Day #4, part two: ' . puzzle8('./input/day4.txt') . PHP_EOL;
