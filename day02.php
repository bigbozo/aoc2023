<?php

use Bizbozo\Adventofcode2023\Day02\Solution;

require 'vendor/autoload.php';


Solution::solve(file('input/day2-test.txt'))->output('Test');
Solution::solve(file('input/day2.txt'))->output('Live');


