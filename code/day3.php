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
        for ($i = 0; $i < strlen($part1); $i++)
            if (str_contains($part2, $part1[$i])) {
                array_push($intersections, $part1[$i]);
                break;
            }
    }
    $priorities = array_map('priority', $intersections);
    return array_sum($priorities);
}


function puzzle6($input_file)
{
    $data = trim(read_file($input_file));
    $rucksacks = preg_split('/\r?\n/', $data);
    $intersections = [];
    for ($i = 0; $i < sizeof($rucksacks); $i += 3)
        for ($j = 0; $j < strlen($rucksacks[$i]); ++$j) {
            $ch = $rucksacks[$i][$j];
            if (str_contains($rucksacks[$i + 1], $ch) && str_contains($rucksacks[$i + 2], $ch)) {
                array_push($intersections, $ch);
                break;
            }
        }
    $priorities = array_map('priority', $intersections);
    return array_sum($priorities);
}

echo 'Day3, part one: ' . puzzle5('./input/day3.txt') . PHP_EOL;
echo 'Day3, part two: ' . puzzle6('./input/day3.txt') . PHP_EOL;
