<?php

require_once('../../file-handle.php');

/**
 * X => 0
 * Y => 3
 * Z => 6
 */
function matches(){
    $points = ['X' => 0, 'Y'=> 3, 'Z' => 6];
    $shape = ['A' => 1, 'B'=> 2, 'C' => 3];
    $result = array();
    $data = trim(read_file('../../input/day2.txt'));
    $rounds = explode("\n",$data);
    foreach($rounds as $round){
        $columns = explode(' ',$round);
        $score = rank($columns[1],$columns[0],$points,$shape);
        array_push($result,$score);
    }
    return array_sum($result);
}
function rank($suggest,$opponent,$points,$shape){
    $score = $points[$suggest];
    switch($suggest){
        case 'X':
            $score += ($shape[$opponent] > 1) ? $shape[$opponent] - 1 : 3;
            break;
        case 'Y':
            $score += $shape[$opponent];
            break;
        case 'Z':
            $score += ($shape[$opponent] < 3) ? $shape[$opponent] + 1 : 1;
            break;
    }
    return $score;
}

echo matches().PHP_EOL;