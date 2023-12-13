<?php

namespace Bizbozo\Adventofcode2023\Day12;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    /**
     * @param array $lines
     * @return array{pattern: string[], numbers: int[][]}
     */
    private static function parseData(array $lines): array
    {
        $data = [];
        foreach ($lines as $line) {
            if (!trim($line)) continue;
            list($pattern, $numbers) = explode(" ", $line, 2);
            $numbers = array_map(fn($n) => (int)$n, explode(',', $numbers));
            $data[] = compact('pattern', 'numbers');
        }
        return $data;
    }

    #[\Override] public static function solve(string $inputStream, string $inputStream2 = null): SolutionResult
    {

        $records = static::parseData(explode(PHP_EOL, $inputStream));
        $sum = array_sum(array_map(function ($record) use ($records) {

            return static::countVariants($record['pattern'], $record['numbers']);

        }, $records));

        $sum2 = array_sum(array_map(function ($record) use ($records) {

            return static::countVariants(...static::foldOut($record['pattern'],$record['numbers']));

        }, $records));


        return new SolutionResult(
            12,
            new UnitResult('', $sum, ''),
            new UnitResult('', $sum2, '')
        );
    }

    private static function countVariants(mixed $pattern, mixed $numbers): int
    {

        if (!count($numbers)) {
            if (str_contains($pattern, '#')) return 0;
            return 1;
        }
        $counter = 0;
        $nextChar = substr($pattern, 0, 1);
        if ($nextChar === '.' || $nextChar === '?') {
            $counter += self::countVariants(substr($pattern, 1), $numbers);
        }
        if (($nextChar === '#' || $nextChar === '?')
            && strlen($pattern) >= $numbers[0]
            && !str_contains(substr($pattern, 0, $numbers[0]), '.')
            && (strlen($pattern) == $numbers[0] || substr($pattern, $numbers[0], 1) != '#')
        ) {

            $counter += self::countVariants(substr($pattern, $numbers[0] + 1), array_slice($numbers, 1));
        }
        return $counter;
    }

    private static function foldOut(string $pattern, array $numbers)
    {
        return [
            implode("?", array_fill(0,5,$pattern)),
            array_merge($numbers,$numbers,$numbers,$numbers,$numbers)
        ];

    }


}
