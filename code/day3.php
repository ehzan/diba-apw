<?php
include 'file-handle.php';

function priority($char)
{
    return ctype_lower($char) ?
        (ord($char) - ord('a') + 1) : (ord($char) - ord('A') + 27);
}

function puzzle5($input_file)
{
    $data = trim(read_file($input_file));
    $rucksacks = preg_split('/\r?\n/', $data);
    $intersections = [];
    foreach ($rucksacks as $rucksack) {
        $middle = strlen($rucksack) / 2;
        $part1 = substr($rucksack, 0, $middle);
        $part2 = substr($rucksack, $middle, $middle);
        for ($i = 0; $i < strlen($part1); $i++) {
            if (str_contains($part2, $part1[$i])) {
                array_push($intersections, $part1[$i]);
                break;
            }
        }
    }
    $intersections = array_map('priority', $intersections);
    return array_sum($intersections);
}


echo 'Day #3, part one: ' . puzzle5('./input/day3.txt') . PHP_EOL;
