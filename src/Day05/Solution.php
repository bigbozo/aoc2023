<?php

namespace Bizbozo\Adventofcode2023\Day05;

use Bizbozo\Adventofcode2023\Solutions\SolutionInterface;
use Bizbozo\Adventofcode2023\Solutions\SolutionResult;
use Bizbozo\Adventofcode2023\Solutions\UnitResult;

class Solution implements SolutionInterface
{

    /**
     * Solves the given problem.
     *
     * @param string $inputStream The input stream containing the problem data.
     * @return SolutionResult The solution result containing the lowest location numbers.
     */
    #[\Override] public static function solve(string $inputStream): SolutionResult
    {

        list($seeds, $steps) = static::parseInput($inputStream);

        // Part 1
        $finalValues = [];
        foreach ($seeds as $seed) {
            foreach ($steps as $step) {
                $seed = static::makeStep($seed, $step);
            }
            $finalValues[] = $seed;
        }

        // Part 2
        $seedIntervals = array_chunk($seeds, 2);
        $minLocations = [];
        foreach ($seedIntervals as $seedInterval) {
            $intervals = [
                [
                    'start' => (int)$seedInterval[0],
                    'end' => (int)$seedInterval[0] + $seedInterval[1] - 1,
                ]
            ];
            foreach ($steps as $step) {
                $newIntervals = [];
                foreach ($step as $rule) {
                    $ruleRight = $rule['source'] + $rule['width'] - 1;
                    for ($i = 0; $i < count($intervals); $i++) {
                        $interval = $intervals[$i];
                        if (
                            $interval['start'] > $ruleRight ||
                            $interval['end'] < $rule['source']
                        ) {
                            // außerhalb, muss für nächste Regel erhalten bleiben
                        }
                        elseif (
                            $interval['start'] < $rule['source'] &&
                            $interval['end'] > $ruleRight
                        ) {
                            // umgebend
                            array_splice($intervals, $i--, 1);
                            $newIntervals[] = ['start' => $rule['source'], 'end' => $ruleRight];
                            $intervals[] = ['start' => $interval['start'], 'end' => $rule['source'] - 1];
                            $intervals[] = ['start' => $ruleRight + 1, 'end' => $interval['end']];

                        }
                        elseif (
                            $interval['start'] >= $rule['source'] &&
                            $interval['end'] <= $ruleRight
                        ) {
                            // innerhalb, volle Verschiebung
                            array_splice($intervals, $i--, 1);
                            $newIntervals[] = [
                                'start' => $interval['start'] + $rule['offset'],
                                'end' => $interval['end'] + $rule['offset']
                            ];

                        }
                        elseif (
                            $interval['start'] < $rule['source']
                        ) {
                            // Überschneidung von links
                            array_splice($intervals, $i--, 1);
                            $intervals[] = [
                                'start' => $interval['start'],
                                'end' => $rule['source'] - 1
                            ];
                            $newIntervals[] = [
                                'start' => $rule['source'] + $rule['offset'],
                                'end' => $ruleRight + $rule['offset']
                            ];
                        }
                        else {
                            // Überschneidung von rechts
                            // links offset anwenden
                            array_splice($intervals, $i--, 1);
                            $newIntervals[] = [
                                'start' => $interval['start'] + $rule['offset'],
                                'end' => $ruleRight + $rule['offset']
                            ];
                            // rechts kein offset
                            $intervals[] = [
                                'start' => $ruleRight + 1,
                                'end' => $interval['end']
                            ];
                        }
                    }
                }
                $intervals = array_merge($intervals, $newIntervals);
            }
            $minLocation = min(array_map(function ($interval) {
                return $interval['start'];
            }, $intervals));
            $minLocations[] = $minLocation;

        }
        sort($minLocations);
        $amount2 = min($minLocations);

        return new SolutionResult(
            5,
            new UnitResult('lowest location number', min($finalValues), 'loc'),
            new UnitResult('lowest location number', $amount2, 'loc')
        );
    }

    private static function parseInput($inputStream)
    {
        $parts = explode(PHP_EOL . PHP_EOL, $inputStream);
        $seeds = explode(' ', explode('seeds: ', $parts[0])[1]);
        $steps = [
            static::parseStep(explode('seed-to-soil map:' . PHP_EOL, $parts[1])),
            static::parseStep(explode('soil-to-fertilizer map:' . PHP_EOL, $parts[2])),
            static::parseStep(explode('fertilizer-to-water map:' . PHP_EOL, $parts[3])),
            static::parseStep(explode('water-to-light map:' . PHP_EOL, $parts[4])),
            static::parseStep(explode('light-to-temperature map:' . PHP_EOL, $parts[5])),
            static::parseStep(explode('temperature-to-humidity map:' . PHP_EOL, $parts[6])),
            static::parseStep(explode('humidity-to-location map:' . PHP_EOL, $parts[7])),
        ];

        return [$seeds, $steps];
    }

    private static function parseStep($stepString)
    {
        $rules = [];
        foreach (explode(PHP_EOL, $stepString[1]) as $step) {
            if ($step) {
                list($dest, $source, $width) = explode(' ', $step);
                $dest = (int)$dest;
                $source = (int)$source;
                $width = (int)$width;
                $offset = $dest - $source;
                $rules[] = compact('dest', 'source', 'width', 'offset');
            }
        }
        return $rules;
    }

    private static function makeStep($seed, $step)
    {
        foreach ($step as $rule) {
            if ($seed >= $rule['source'] && $seed < $rule['source'] + $rule['width']) {
                return $seed + $rule['dest'] - $rule['source'];
            }
        }
        return $seed;
    }
}
