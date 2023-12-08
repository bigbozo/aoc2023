<?php

namespace Bizbozo\Adventofcode2023\Day08;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    private static function parseData(array $lines)
    {
        $instructions = array_shift($lines);
        array_shift($lines);
        $nodes = [];
        foreach ($lines as $line) {
            if (preg_match('/(\w+) = \((\w+), (\w+)\)/', $line, $match)) {
                $nodes[$match[1]] = ['L' => $match[2], 'R' => $match[3]];
            }

        }
        return [$instructions, $nodes];

    }

    #[\Override] public static function solve(string $inputStream): SolutionResult
    {

        list($instructions, $nodes) = static::parseData(explode(PHP_EOL, $inputStream));

        $steps = 0;
        $cursor = 0;
        $node = 'AAA';
        $instructionLength = strlen($instructions);
        do {
            $node = $nodes[$node][$instructions[$steps % $instructionLength]];
            $steps++;
        } while ($node!=='ZZZ');

        return new SolutionResult(
            8,
            new UnitResult('', $steps, ''),
            new UnitResult('', 0, '')
        );
    }
}
