<?php

class Input{
    public static function content(int $day){
        $input = file_get_contents(__DIR__.'/day'.$day.'/input.txt') ?: throw new Exception('Failed to read input file.');
        return $input;
    }
}