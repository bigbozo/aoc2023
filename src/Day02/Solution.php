<?php

namespace Bizbozo\Adventofcode2023\Day02;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{
    static function parseData($strean)
    {
        $games = [];
        foreach ($strean as $line) {
            // Capture id and subsets: Game (3): (8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red)
            if (preg_match('/Game\s(\d+):\s(.*)$/', chop($line), $match)) {
                // match: 1=> Game-ID, 2=> subsets
                $games[$match[1]] = new Game(array_reduce(explode('; ', $match[2]), function ($carry, $subset) {
                    // subset: e.g. 8 green, 6 blue, 20 red
                    $draw = [];
                    $colorCounts = explode(', ', $subset);
                    foreach ($colorCounts as $colorCount) {
                        // colorCount: e.g. 8 green
                        list($count, $color) = explode(' ', $colorCount);
                        $draw[$color] = $count;
                    }
                    // draw: e.g. [red: 20, green: 8, blue: 6]
                    $carry[] = CubeDraw::fromTest($draw);
                    return $carry;
                }, []));
            };
        }
        return $games;
    }

    public static function solve($inputStream): SolutionResult
    {

        $games = static::parseData(explode(PHP_EOL, $inputStream));

        $setPowerSum = 0;
        $score = 0;
        foreach ($games as $id => $game) {
            /** @var Game $game */
            // named arguments for clearer function call ;)
            if ($game->isValid(red: 12, green: 13, blue: 14)) {
                $score += $id;
            }
            // use what is already there
            $setPowerSum += $game->getMinCubes()->power();
        }

        return new SolutionResult(
            2,
            new UnitResult("Score", $score, 'points'),
            new UnitResult("Set-Power-Sum", $score, 'powerpoints')
        );

    }
}
