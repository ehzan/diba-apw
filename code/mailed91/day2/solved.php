<?php

namespace Day2;

class Day2{
    private string $data = '';
    private string $path = '/home/milad/input';
    private array $rounds;
    private array $partOne = [];
    private array $partTwo = [];
  
    /** 
     * A => Rock, B => Paper, C => Scissors
     * X => Rock, Y => Paper, Z => Scissors */

    private array $tools = [
        'A' => 1, 'B' => 2, 'C' => 3,
        'X' => 1, 'Y' => 2, 'Z' => 3
    ];
  
    /**
     * A,B,C = X,Y,Z
     * A > Z
     * B > X
     * C > Y
     */
  
    private array $comparisonOne = [
        'A,X' => 3, 'A,Y' => 6, 'A,Z' => 0,
        'B,X' => 0, 'B,Y' => 3, 'B,Z' => 6,
        'C,X' => 6, 'C,Y' => 0, 'C,Z' => 3
    ];
  
    private array $comparisonTwo = [
        'A,X' => 3, 'A,Y' => 4,'A,Z' => 8,
        'B,X' => 1, 'B,Y' => 5,'B,Z' => 9,
        'C,X' => 2, 'C,Y' => 6,'C,Z' => 7
    ];
  
    public function __constructor(){
        $file = fopen($this->path,'r');
        $this->data = fread($file,filesize($this->path));
        fclose($file);
    }
  
    public function solve(){
        $this->rounds = explode(PHP_EOL,$this->data);
        $this->match();
        echo array_sum($this->partOne).PHP_EOL.array_sum($this->partTwo);
    }
  
    private function match(){
        foreach($this->rounds as $round){
            $columns = explode(' ',$round);
            $enemy = $columns[0];
            $me = $columns[1];
            $this->partOne[] = $this->tools[$me] + $this->comparisonOne[$enemy.','.$me];
            $this->partTwo[] = $this->comparisonTwo[$enemy.','.$me];
        }
    }
}