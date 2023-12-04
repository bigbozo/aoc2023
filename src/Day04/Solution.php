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
        $copies=array_fill(0,count($data),1);
        foreach ($data as $card_number => $card) {
            $count = count(array_intersect($card['win'], $card['test']));
            $num_cards = $copies[$card_number];
            if ($count>0) {
                $score += pow(2, $count -1);
                for ($i=0;$i<$count;$i++) {
                    if (isset($copies[$card_number+$i+1])) {
                        $copies[$card_number+$i+1]+=$num_cards;
                    } else {
                        $copies[$card_number+$i+1]=$num_cards;
                    }
                }
            }
        }

        return new SolutionResult(
            4,
            new UnitResult('Points', $score, 'pt'),
            new UnitResult('Points', array_sum($copies), 'pt')
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
