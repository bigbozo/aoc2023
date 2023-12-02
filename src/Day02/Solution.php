<?php

namespace Bizbozo\Adventofcode2023\Day02;

class Solution
{
    static function parseData($data)
    {
        $games = [];
        foreach ($data as $line) {
            if (preg_match('/Game\s(\d+):\s(.*)$/', chop($line), $match)) {
                $games[$match[1]] = new \Bizbozo\Adventofcode2023\Day02\Game(array_reduce(explode('; ', $match[2]), function ($carry, $subset) {
                    $draw = [];
                    $colorCounts = explode(', ', $subset);
                    foreach ($colorCounts as $colorCount) {
                        list($count, $color) = explode(' ', $colorCount);
                        $draw[$color] = $count;
                    }
                    $carry[] = \Bizbozo\Adventofcode2023\Day02\CubeDraw::fromTest($draw);
                    return $carry;
                }, []));
            };
        }
        return $games;
    }

    public static function solve($inputStream)
    {

        $games = static::parseData($inputStream);

        $setPowerSum =0;
        $score = 0;
        foreach ($games as $id => $game) {
            /** @var Game $game */
            if ($game->isValid(red: 12, green: 13, blue: 14)) {
                $score += $id;
            }
            $setPowerSum += $game->getMinCubes()->power();
        }

        echo "Day 2 - Part 1: The score is " . $score . PHP_EOL;

        echo "Day 2 - Part 2: Set-Power-Sum is ". $setPowerSum . PHP_EOL;

    }
}
