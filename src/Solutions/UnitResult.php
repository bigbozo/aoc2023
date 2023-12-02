<?php

namespace Bizbozo\Adventofcode2023\Solutions;

use Bramus\Ansi\Ansi;
use Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

class UnitResult
{

    private $unit;
    private $amount;
    private $short;

    public function __construct($unit, $amount, $short)
    {
        $this->unit = $unit;
        $this->amount = $amount;
        $this->short = $short;
    }

    public function output()
    {
            return sprintf("The %s is %s %s", $this->unit, $this->amount, $this->short);
    }

}
