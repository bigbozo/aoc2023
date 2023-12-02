<?php

namespace Bizbozo\Adventofcode2023\Day01;

class Solution
{
    public static function solve($inputStream) {
        $values = [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'zero' => 0
        ];

        $sum = 0;
        foreach ($inputStream as $line) {
            if (preg_match('/.*?(\d|one|two|three|four|five|six|seven|eight|nine|zero).*/', $line, $match)) {
                $left = $match[1];
                if (preg_match('/.*(\d|one|two|three|four|five|six|seven|eight|nine|zero).*?/', $line, $match)) {
                    $right = $match[1];

                    $number = $values[$left] . $values[$right];
                    $sum += $number;
                }
            }
        }

        echo $sum .PHP_EOL;

    }

}
