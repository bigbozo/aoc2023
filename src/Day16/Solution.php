<?php

namespace Bizbozo\Adventofcode2023\Day16;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;
use Override;

class Solution implements SolutionInterface
{

    private static function parseData(array $lines): int
    {
        return 1;
    }

    #[Override] public static function solve(string $inputStream, string $inputStream2 = null): SolutionResult
    {

        $data = static::parseData(explode(PHP_EOL, $inputStream));

        return new SolutionResult(
            16,
            new UnitResult('',0,''),
            new UnitResult('',0,'')
        );
    }
}
