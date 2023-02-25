<?php
include 'file-handle.php';


function retrieve_stacks($strStacks)
{
    $lines = explode("\n", $strStacks);
    $last_line = array_pop($lines);
    $number_of_stacks = preg_match_all('/\d+/', $last_line);
    $stacks = array_fill(1, $number_of_stacks, []);
    $lines = array_reverse($lines);
    foreach ($lines as $line) {
        preg_match_all('/[\[ ](\w+| )[\] ]\s?/', $line, $matches);
        foreach ($matches[1] as $key => $item) {
            if ($item != ' ')
                array_push($stacks[$key + 1], $item);
        }
    }
    return ($stacks);
}

function puzzle9($input_file)
{
    $data = rtrim(read_file($input_file));
    [$strStacks, $strInstructions] = preg_split('/(\r?\n){2}/', $data);
    $stacks = retrieve_stacks($strStacks);
    $instructions = explode("\n", $strInstructions);
    foreach ($instructions as $instruct) {
        [, $number, $origin, $destionation] = preg_split('/move | from | to /', $instruct);
        for ($i = 0; $i < $number; $i++) {
            array_push($stacks[$destionation], array_pop($stacks[$origin]));
        }
    }
    $tops = '';
    foreach ($stacks as $stack) {
        $tops .= end($stack);
    }
    return $tops;
}

function puzzle10($input_file)
{
    $data = rtrim(read_file($input_file));
    [$strStacks, $strInstructions] = preg_split('/(\r?\n){2}/', $data);
    $stacks = retrieve_stacks($strStacks);
    $instructions = explode("\n", $strInstructions);
    foreach ($instructions as $instruct) {
        [, $number, $origin, $destionation] = preg_split('/move | from | to /', $instruct);
        // $stacks[$destionation] = array_merge($stacks[$destionation], array_slice($stacks[$origin], -intval($number)));
        array_push($stacks[$destionation], ...array_slice($stacks[$origin], -intval($number)));
        $stacks[$origin] = array_slice($stacks[$origin], 0, -intval($number));
    }
    $tops = '';
    foreach ($stacks as $stack) {
        $tops .= end($stack);
    }
    return $tops;
}


echo 'Day #5, part one: ' . puzzle9('./input/day5.txt') . PHP_EOL;
echo 'Day #5, part two: ' . puzzle10('./input/day5.txt') . PHP_EOL;
