<?php

namespace Bizbozo\Adventofcode2023\Day04;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{


    #[\Override]
    public static function solve($inputStream): SolutionResult
    {
        $data = static::parseInput($inputStream);

        $score = 0;
        foreach ($data as $card) {
            $count = count(array_intersect($card['win'], $card['test']));
            if ($count>0) {
                $score += pow(2, $count -1);
            }
        }


        return new SolutionResult(
            4,
            new UnitResult('Points', $score, 'pt'),
            new UnitResult('Points', $score, 'pt')
        );
    }

    private static function parseInput($inputStream)
    {
        $data = [];
        foreach ($inputStream as $line) {
            list($card, $numbers) = explode(': ', chop($line));
            list($winNumbers, $testNumbers) = explode('| ', $numbers);
            $data[] = [
                'win' => preg_split('/\s+/', trim($winNumbers)),
                'test' => preg_split('/\s+/', trim($testNumbers)),
            ];
        }
        return $data;
    }
}
