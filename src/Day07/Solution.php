<?php

namespace Bizbozo\Adventofcode2023\Day07;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    #[\Override] public static function solve($inputStream): SolutionResult
    {

        $data = static::parseInput($inputStream);
        usort($data,fn($a,$b) => $a['score']<=>$b['score']);
        $part1Score = 0;
        foreach ($data as $rank=>$hand) {
            $part1Score+=($rank+1) * $hand['bidding'];
        }
        return new SolutionResult(
            7,
            new UnitResult('', $part1Score, ''),
            new UnitResult('', 0, '')
        );
    }

    private static function parseInput($inputStream)
    {
        $lines = explode(PHP_EOL, $inputStream);
        foreach ($lines as $line) {
            if (!trim($line)) continue;
            list($hand, $bidding) = explode(" ", $line);
            $hand = str_split($hand);
            $hands[] = [
                'hand' => $hand,
                'bidding' => $bidding,
                'score' => static::scoreHand($hand)
            ];
        }
        return $hands;
    }

    private static function scoreHand($hand)
    {
        $scores = array_flip(['11111', '1112', '122', '113', '23', '14', '5']);
        $cardValues = array_flip([2, 3, 4, 5, 6, 7, 8, 9, 'T', 'J', 'Q', 'K', 'A']);
        $sortedHand = [];
        foreach ($hand as $card) {
            $sortedHand[$card] = isset($sortedHand[$card]) ? $sortedHand[$card] + 1 : 1;
        }
        sort($sortedHand);
        $score = $scores[implode('', $sortedHand)];
        foreach ($hand as $value) {
            $score <<=4;
            $score+=$cardValues[$value];
        }
        return $score;
    }
}
