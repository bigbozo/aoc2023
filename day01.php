<?php

use Bizbozo\Adventofcode2023\Day01\Solution;

require 'vendor/autoload.php';

echo "Test 1: ";
Solution::solve(file('input/day1-test.txt')) . PHP_EOL;

echo "Test 2: ";
Solution::solve(file('input/day1-test2.txt')) . PHP_EOL;

echo "Live: ";
Solution::solve(file('input/day1.txt')) . PHP_EOL;
