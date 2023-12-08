<?php

namespace Bizbozo\Adventofcode2023\Solutions;

interface SolutionInterface
{
    public static function solve(string $inputStream, string $inputStream2 = null): SolutionResult;
}
