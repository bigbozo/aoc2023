<?php

namespace Bizbozo\Adventofcode2023\Day03;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    #[\Override] public static function solve(string $inputStream): SolutionResult
    {

        $data = static::parseInput(explode(PHP_EOL,$inputStream));

        $sum = 0;
        $symbol_numbers = [];
        foreach ($data['symbols'] as $symbol) {

            for ($x = -1; $x <= 1; $x++) {
                for ($y = -1; $y <= 1; $y++) {
                    $number_id = isset($data['field'][$x + $symbol['position']['x']][$y + $symbol['position']['y']]) ? $data['field'][$x + $symbol['position']['x']][$y + $symbol['position']['y']] : -1;
                    if ($number_id > -1) {
                        $symbol_numbers[$number_id] = $data['numbers'][$number_id];
                    }
                }
            }
        }
        $part1sum = array_sum($symbol_numbers);

        // Part 2
        foreach ($data['symbols'] as $symbol) {
            $symbol_numbers = [];
            if ($symbol['char'] !== '*') continue;
            for ($x = -1; $x <= 1; $x++) {
                for ($y = -1; $y <= 1; $y++) {
                    $number_id = isset($data['field'][$x + $symbol['position']['x']][$y + $symbol['position']['y']]) ? $data['field'][$x + $symbol['position']['x']][$y + $symbol['position']['y']] : -1;
                    if ($number_id > -1) {
                        $symbol_numbers[$number_id] = $data['numbers'][$number_id];
                    }
                }
            }

            if (count($symbol_numbers) === 2) {
                $gearCount = 1;
                foreach ($symbol_numbers as $number) {
                    $gearCount *= $number;
                }
                $gear_numbers[] = $gearCount;
            }
        }


        return new SolutionResult(3,
            new UnitResult('Partnumber-Sum', $part1sum, 'pns'),
            new UnitResult('Gear-Ratio-Sum', array_sum($gear_numbers), 'grs')
        );

    }

    private static function parseInput($inputStream)
    {
        $numbers = [];
        $symbols = [];
        $field = [];
        $current_id = 0;
        foreach ($inputStream as $y => $line) {
            $line = chop($line) . '.';
            $numStart = -1;
            for ($x = 0; $x < strlen($line); $x++) {
                $char = $line[$x];
                if ($numStart === -1) {
                    // Space
                    if ($char === '.') continue;
                    if (is_numeric($char)) {
                        // Digit
                        $numStart = $x;
                        $number = $char;
                    } else {
                        // Symbol
                        $symbols[] = [
                            'position' => ['x' => $x, 'y' => $y],
                            'char' => $char
                        ];
                    }
                } else {
                    if (is_numeric($char)) {
                        // Digit
                        $number .= $char;
                    } else {
                        // Space
                        $numbers[$current_id] = (int)$number;
                        for ($i = 1; $i <= strlen($number); $i++) {
                            $field[$x - $i][$y] = $current_id;
                        }
                        $current_id++;
                        $numStart = -1;
                        $number = '';
                        if ($char !== '.') {
                            // Symbol
                            $symbols[] = [
                                'position' => ['x' => $x, 'y' => $y],
                                'char' => $char
                            ];
                        }
                    }
                }
            }
        }

        return [
            'numbers' => $numbers,
            'symbols' => $symbols,
            'field' => $field,
        ];
    }
}
