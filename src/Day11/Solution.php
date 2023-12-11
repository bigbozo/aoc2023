<?php

namespace Bizbozo\Adventofcode2023\Day11;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    private static function parseData(array $lines)
    {
        $lines = array_filter($lines, fn($line) => trim($line));
        $galaxyField = new GalaxyField(strlen($lines[0]), count($lines));
        foreach ($lines as $y => $line) {
            $x = -1;
            while (($x = strpos($line, '#', $x + 1)) !== false) {
                $galaxyField->addGalaxy($x, $y);
            }
        }
        return $galaxyField;
    }

    #[\Override] public static function solve(string $inputStream, string $inputStream2 = null): SolutionResult
    {

        $galaxyField = static::parseData(explode(PHP_EOL, $inputStream));


        return new SolutionResult(
            11,
            new UnitResult('', $galaxyField->distances(2), ''),
            new UnitResult('', $galaxyField->distances(1000000), '')
        );
    }
}
