<?php
include 'file-handle.php';


function puzzle1($input_file)
{
    $data = trim(read_file($input_file));
    $food_lists = preg_split("/(\r?\n){2}/", $data);
    $max = 0;
    foreach ($food_lists as $food_list_string) {
        $food_list = explode("\n", $food_list_string);
        // $food_list = array_map('intval', $food_list);
        $sum = array_sum($food_list);
        $max = max($sum, $max);
    }
    return $max;
}

function swap(&$val1, &$val2)
{
    $temp = $val1;
    $val1 = $val2;
    $val2 = $temp;
}

function puzzle2($input_file)
{
    $data = trim(read_file($input_file));
    $food_lists = preg_split("/(\r?\n){2}/", $data);
    $max1 = 0;
    $max2 = 0;
    $max3 = 0;
    foreach ($food_lists as $food_list_string) {
        $food_list = explode("\n", $food_list_string);
        $sum = array_sum($food_list);
        if ($max3 < $sum)
            $max3 = $sum;
        if ($max2 < $max3)
            swap($max2, $max3);
        if ($max1 < $max2)
            swap($max1, $max2);
    }
    return $max1 + $max2 + $max3;
}


echo 'Day #1, part one: ' . puzzle1('.\input\day1.txt') . PHP_EOL;
echo 'Day #1, part two: ' . puzzle2('.\input\day1.txt') . PHP_EOL;
