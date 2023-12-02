<?php

class CubeDraw
{
    public int $red = 0;
    public int $green = 0;
    public int $blue = 0;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public static function fromTest($test): CubeDraw
    {
        return new static(
            (int)($test['red'] ?? 0),
            (int)($test['green'] ?? 0),
            (int)($test['blue'] ?? 0)
        );
    }

    public function power()
    {
        return $this->red * $this->green * $this->blue;
    }

    public function riseMax(CubeDraw $draw) {
        $this->red = max($this->red,$draw->red);
        $this->green = max($this->green,$draw->green);
        $this->blue = max($this->blue,$draw->blue);
    }
}

class Game
{

    /**
     * @var CubeDraw[]
     */
    public array $draws = [];

    /**
     * @param CubeDraw[] $draws
     */
    public function __construct(array $draws)
    {
        $this->draws = $draws;
    }

    public function isValid($red = 0, $green = 0, $blue = 0)
    {
        foreach ($this->draws as $draw) {
            if ($draw->red > $red) return false;
            if ($draw->green > $green) return false;
            if ($draw->blue > $blue) return false;
        }
        return true;
    }

    public function getMinCubes()
    {
        return array_reduce($this->draws, function ($carry, $draw) {
            $carry->riseMax($draw);
            return $carry;
        }, new CubeDraw());

    }
}

function parseData($data)
{
    $games = [];
    foreach ($data as $line) {
        if (preg_match('/Game\s(\d+):\s(.*)$/', chop($line), $match)) {
            $games[$match[1]] = new Game(array_reduce(explode('; ', $match[2]), function ($carry, $subset) {
                $draw = [];
                $colorCounts = explode(', ', $subset);
                foreach ($colorCounts as $colorCount) {
                    list($count, $color) = explode(' ', $colorCount);
                    $draw[$color] = $count;
                }
                $carry[] = CubeDraw::fromTest($draw);
                return $carry;
            }, []));
        };
    }
    return $games;
}

$games = parseData(file('input/day2.txt'));

$setPowerSum =0;
foreach ($games as $id => $game) {
    /** @var Game $game */
    if ($game->isValid(red: 12, green: 13, blue: 14)) {
        $score += $id;
    }
    $setPowerSum += $game->getMinCubes()->power();
}

echo "Day 2 - Part 1: The score is " . $score . PHP_EOL;

echo "Day 2 - Part 2: Set-Power-Sum is ". $setPowerSum;



