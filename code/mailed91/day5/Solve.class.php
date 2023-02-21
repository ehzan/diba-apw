<?php

class Solve
{
    private readonly string $str_boxes;
    private readonly string $str_orders;

    private array $boxes;
    private array $orders;

    public function __construct(string $input)
    {
        [$this->str_boxes, $this->str_orders] = explode("\n\n", $input);

        $this->boxes = $this->parseBoxes($this->str_boxes);
        $this->orders = $this->parseOrders($this->str_orders);
    }

    private function parseBoxes(string $str_boxes): array
    {
        $boxes = explode(PHP_EOL, $str_boxes);
        $result = [];

        foreach ($boxes as $box) {
            $lineOfBoxes = str_split($box, 4);
            foreach ($lineOfBoxes as $row => $box) {
                preg_match('/[a-zA-Z]/', $box, $boxNum);
                $value = reset($boxNum);
                if (!empty($value)) {
                    !empty($result[$row + 1]) ? array_unshift($result[$row + 1], $value) : $result[$row + 1][] = $value;
                }
            }
        }

        ksort($result, SORT_NUMERIC);
        return $result;
    }

    private function parseOrders(string $str_orders): array
    {
        $lineOfOrders = explode(PHP_EOL, $str_orders);
        $result = [];

        foreach ($lineOfOrders as $row => $order) {
            preg_match_all('/(.*?)\s\d+/', $order, $orderNum);
            foreach (reset($orderNum) as $order) {
                [$move, $step] = explode(' ', trim($order));
                $result[$row][$move] = $step;
            }
        }
        return $result;
    }

    public function calculate(bool $part2 = false): string
    {
        foreach ($this->orders as $step) {
            $move = $step['move'];
            $from = $step['from'];
            $to = $step['to'];
            
            $elements = array_slice($this->boxes[$from], -(int) $move);

            if(!$part2){
                krsort($elements, SORT_NUMERIC);
            }
            
            array_splice($this->boxes[$from], count($this->boxes[$from]) - (int) $move, (int) $move);

            $this->boxes[$to] = array_merge($this->boxes[$to], $elements);
        }

        $message = '';
        foreach ($this->boxes as $row) {
            $message .= end($row);
        }

        return $message;
    }
}
