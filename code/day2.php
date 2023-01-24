<?php
include 'file-handle.php';

function puzzle3($input_file)
{
    $data = read_file($input_file);
    $data = trim($data);
    $rounds = explode("\n", $data);
    $dict = [
        'A' => 1, 'B' => 2, 'C' => 3,
        'X' => 1, 'Y' => 2, 'Z' => 3,
    ];
    $total_score = 0;
    foreach ($rounds as $rnd) {
        $hand1 = $dict[$rnd[0]];    // $hand1 = ord($rnd[0]) - ord('A') + 1;
        $hand2 = $dict[$rnd[2]];    // $hand2 = ord($rnd[2]) - ord('X') + 1;
        $score = $hand2;
        switch ($hand2 - $hand1) {
            case 0: // draw
                $score += 3;
                break;
            case 1:
            case -2: // win
                $score += 6;
                break;
        }
        $total_score += $score;
    }
    return $total_score;
}


echo 'Day #2, part one: ' . puzzle3('./input/day2.txt') . PHP_EOL;
