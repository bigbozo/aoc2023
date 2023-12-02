<?php

use Bizbozo\Adventofcode2023\Day01\Solution;

require 'vendor/autoload.php';

Solution::solve(file('input/day1-test.txt'))->output("Test 1: ");

Solution::solve(file('input/day1-test2.txt'))->output("Test 2: ");

Solution::solve(file('input/day1.txt'))->output("Live: ");
