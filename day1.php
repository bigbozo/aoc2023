<?php

$data = file('input/day1.txt');

$sum = 0;
foreach ($data as $line) {
    if (preg_match('/.*?(\d).*/', $line, $match)) {
        $left = $match[1];
        if (preg_match('/.*(\d).*?/', $line, $match)) {
            $sum += $left * 10 + $match[1];
        }
    }
}

echo $sum;
