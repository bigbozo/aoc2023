<?php

use Bizbozo\Adventofcode2023\Day05\Solution;

require 'vendor/autoload.php';

Solution::solve(file_get_contents('input/day05-test.txt'))->output('Test');
Solution::solve(file_get_contents('input/day05.txt'))->output('Live');


