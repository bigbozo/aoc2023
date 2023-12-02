<?php

use Bizbozo\Adventofcode2023\Day02\Solution;

require 'vendor/autoload.php';

echo "Test:" . PHP_EOL;
Solution::solve(file('input/day2-test.txt'));

echo "Live:" . PHP_EOL;
Solution::solve(file('input/day2.txt'));


