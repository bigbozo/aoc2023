<?php

namespace Bizbozo\Adventofcode2023\Day02;


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
