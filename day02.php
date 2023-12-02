<?php

class CubeDraw
{
    public int $red = 0;
    public int $green = 0;
    public int $blue = 0;

    public function __construct($red, $green, $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public static function fromTest($test): CubeDraw
    {
        return new static((int)$test['red'] ?? 0, (int)$test['green'] ?? 0, (int)$test['blue'] ?? 0);
    }
}

function parseData($data)
{
    $games = [];
    foreach ($data as $line) {
        if (preg_match('/Game\s(\d+):\s(.*)$/', chop($line), $match)) {
            $games[$match[1]] = array_reduce(explode('; ', $match[2]), function ($carry, $subset) {
                $draw = [];
                $colorCounts = explode(', ', $subset);
                foreach ($colorCounts as $colorCount) {
                    list($count, $color) = explode(' ', $colorCount);
                    $draw[$color] = $count;
                }
                $carry[] = CubeDraw::fromTest($draw);
                return $carry;
            }, []);
        };
    }
    return $games;
}

$data = parseData(file('input/day2-test.txt'));

var_export($data);
