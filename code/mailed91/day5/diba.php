<?php

include_once '../Input.class.php';

$input = Input::content(5);

[$strStacks,$strInstructions] = preg_split('/(\r?\n){2}/',$input);

$strStacks = explode("\n",$strStacks);

// get array of boxes
$stacks = [];
foreach($strStacks as $strStack){
    $arrayStack = str_split($strStack,4);
    foreach($arrayStack as $key => $item){
        preg_match('/[a-zA-Z]/',$item,$stack_matches);
        $stack = reset($stack_matches);
        if(!empty($stack)) 
            !empty($stacks[$key+1]) ? array_unshift($stacks[$key+1],$stack) : $stacks[$key+1][] = $stack;
    }
}
ksort($stacks,SORT_NUMERIC);

// get array of command
$arrayInstructions = explode("\n",trim($strInstructions));
$instructions = [];
foreach($arrayInstructions as $key => $instruction){
    preg_match_all('/(.*?)\s\d+/',$instruction,$instruct_matches);
    foreach(reset($instruct_matches) as $item){
        [$command,$num] = explode(' ',trim($item));
        $instructions[$key][$command] = $num;
    }
}

foreach($instructions as $instaruct){
    $move = $instaruct['move'];
    $from = $instaruct['from'];
    $to = $instaruct['to'];
    for($i=0;$move>$i;$i++){
        // $item = $stacks[$from][count($stacks[$from])-1];
        // unset($stacks[$from][count($stacks[$from])-1]);
        // $stacks[$from] = array_values($stacks[$from]);
        $item = array_pop($stacks[$from]);
        array_push($stacks[$to],$item);
    }
    // $slice = array_slice($stacks[$from],-(int)$move);
    // krsort($slice,SORT_NUMERIC);
    // array_splice($stacks[$from],count($stacks[$from]) - $move,$move);
    // $stacks[$to] = array_merge($stacks[$to],$slice);
}

$result = '';
foreach($stacks as $stack){
    $result .= end($stack);
}
print_r($result.PHP_EOL);
// FWNSHLDNZ