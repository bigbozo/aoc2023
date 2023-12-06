<?php

namespace Bizbozo\Adventofcode2023\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunSolution extends AbstractCommand
{
    protected function configure()
    {
        $this->setDescription('Run solution')
            ->setName('run')
            ->addArgument('day', InputArgument::REQUIRED, 'Day');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $day = (int)$input->getArgument('day');

        $class = 'Bizbozo\Adventofcode2023\Day' . $this->leadingZero($day) . '\Solution';

        call_user_func([$class, 'solve'], file_get_contents($this->getTestInputFilename($day)))->output('TEST');
        call_user_func([$class, 'solve'], file_get_contents($this->getInputFilename($day)))->output('LIVE');

        return Command::SUCCESS;

    }

}
