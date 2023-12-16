<?php

namespace Bizbozo\Adventofcode2023\Tests\Benchmark;

class Day01Bench
{
    /**
     * @Revs(1000)
     */
    public function benchDay01()
    {

        \Bizbozo\Adventofcode2023\Day01\Solution::solve(file_get_contents($this->getInputFilename(1)));

    }

    /**
     * @Revs(900)
     */
    public function benchDay02()
    {

        \Bizbozo\Adventofcode2023\Day02\Solution::solve(file_get_contents($this->getInputFilename(2)));

    }

    /**
     * @Revs(200)
     */
    public function benchDay03()
    {

        \Bizbozo\Adventofcode2023\Day03\Solution::solve(file_get_contents($this->getInputFilename(3)));

    }

    /**
     * @Revs(1200)
     */
    public function benchDay04()
    {

        \Bizbozo\Adventofcode2023\Day04\Solution::solve(file_get_contents($this->getInputFilename(4)));

    }

    /**
     * @Revs(300)
     */
    public function benchDay05()
    {

        \Bizbozo\Adventofcode2023\Day05\Solution::solve(file_get_contents($this->getInputFilename(5)));

    }

    /**
     * @Revs(1000)
     */
    public function benchDay06()
    {

        \Bizbozo\Adventofcode2023\Day06\Solution::solve(file_get_contents($this->getInputFilename(6)));

    }

    /**
     * @Revs(120)
     */
    public function benchDay07()
    {

        \Bizbozo\Adventofcode2023\Day07\Solution::solve(file_get_contents($this->getInputFilename(7)));

    }

    /**
     * @Revs(16)
     */
    public function benchDay08()
    {

        \Bizbozo\Adventofcode2023\Day08\Solution::solve(file_get_contents($this->getInputFilename(8)));

    }

    /**
     * @Revs(15)
     */
    public function benchDay09()
    {

        \Bizbozo\Adventofcode2023\Day09\Solution::solve(file_get_contents($this->getInputFilename(9)));

    }

    /**
     * @Revs(10)
     */
    public function benchDay10()
    {

        \Bizbozo\Adventofcode2023\Day10\Solution::solve(file_get_contents($this->getInputFilename(10)));

    }

    /**
     * @Revs(5)
     */
    public function benchDay11()
    {

        \Bizbozo\Adventofcode2023\Day11\Solution::solve(file_get_contents($this->getInputFilename(11)));

    }

    /**
     * @Revs(10)
     */
    public function benchDay12()
    {

        \Bizbozo\Adventofcode2023\Day12\Solution::solve(file_get_contents($this->getInputFilename(12)));

    }

    /**
     * @Revs(5)
     */
    public function benchDay13()
    {

        \Bizbozo\Adventofcode2023\Day13\Solution::solve(file_get_contents($this->getInputFilename(13)));

    }

    /**
     * @Revs(5)
     */
    public function benchDay14()
    {

        \Bizbozo\Adventofcode2023\Day14\Solution::solve(file_get_contents($this->getInputFilename(14)));

    }
   /**
     * @Revs(100)
     */
    public function benchDay15()
    {

        \Bizbozo\Adventofcode2023\Day15\Solution::solve(file_get_contents($this->getInputFilename(15)));

    }

    /**
      * @Revs(1)
      */
     public function benchDay16()
     {

         \Bizbozo\Adventofcode2023\Day16\Solution::solve(file_get_contents($this->getInputFilename(16)));

     }

    protected function getInputFilename(int $day)
    {
        return sprintf("%s/../../input/day%s.txt", __DIR__, $this->leadingZero($day));
    }

    /**
     * @param int $day
     * @return string
     */
    protected function leadingZero(int $day): string
    {
        return str_pad($day, 2, '0', STR_PAD_LEFT);
    }

}
