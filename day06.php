<?php

use Bizbozo\Adventofcode2023\Day06\Solution;

require 'vendor/autoload.php';

Solution::solve(file_get_contents('input/day06-test.txt'))->output('Test');
Solution::solve(file_get_contents('input/day06.txt'))->output('Live');


