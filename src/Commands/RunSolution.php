<?php

namespace Bizbozo\Adventofcode2023\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunSolution extends AbstractCommand
{
    protected function configure()
    {
        $this->setDescription('Run solution')
            ->setName('run')
            ->addArgument('day', InputArgument::REQUIRED, 'Day')
            ->addArgument('to_day', InputArgument::OPTIONAL, ' to Day');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);
        $headlines = file(__DIR__ . '/../../Headlines.txt');

        $fromday = (int)$input->getArgument('day');
        $toDay = (int)$input->getArgument('to_day') ?: $fromday;

        for ($day = $fromday; $day <= $toDay; $day++) {


            $class = 'Bizbozo\Adventofcode2023\Day' . $this->leadingZero($day) . '\Solution';
            $testInputFilename = $this->getTestInputFilename($day);
            $inputFilename = $this->getInputFilename($day);


            $style->section(chop($headlines[$day - 1]));
            if (file_exists($testInputFilename)) {
                call_user_func([$class, 'solve'], file_get_contents($testInputFilename))->output('TEST');
            }
            if (file_exists($inputFilename)) {
                call_user_func([$class, 'solve'], file_get_contents($inputFilename))->output('LIVE');
            }
            $style->section('');
        }

        return Command::SUCCESS;

    }

}
