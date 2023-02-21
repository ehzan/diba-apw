<?php

include_once '../Input.class.php';

$input = Input::content(5);

[$boxes,$commands] = preg_split('/(\r?\n){2}/',$input);

$boxes = explode("\n",$boxes);

// get array of boxes
$boxRows = [];
foreach($boxes as $str){
    $arr = str_split($str,4);
    foreach($arr as $key => $item){
        preg_match('/[a-zA-Z]/',$item,$string);
        $val = reset($string);
        if(!empty($val)) 
            !empty($boxRows[$key+1]) ? array_unshift($boxRows[$key+1],$val) : $boxRows[$key+1][] = $val;
    }
}
ksort($boxRows,SORT_NUMERIC);
// get array of command
$commands = explode("\n",trim($commands));
$commandRows = [];
foreach($commands as $key => $str){
    preg_match_all('/(.*?)\s\d+/',$str,$string2);
    foreach(reset($string2) as $item){
        [$move,$num] = explode(' ',trim($item));
        $commandRows[$key][$move] = $num;
    }
}


foreach($commandRows as $command){
    $move = $command['move'];
    $from = $command['from'];
    $to = $command['to'];

    // print_r([$move,$from,$to]);

    $slice = array_slice($boxRows[$from],-(int)$move);
    krsort($slice,SORT_NUMERIC);
    array_splice($boxRows[$from],count($boxRows[$from]) - $move,$move);
    $boxRows[$to] = array_merge($boxRows[$to],$slice);
}

// print_r($boxRows);
// exit;

$result = '';
foreach($boxRows as $row){
    $result .= end($row);
}
print_r($result.PHP_EOL);
// FWNSHLDNZ