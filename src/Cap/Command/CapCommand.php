<?php

namespace Cap\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DescriptorHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Helper\Table;

use Cap\Convertor\TimeConvertor;
use Cap\Maths\Speed;

class CapCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('cap')
            ->addArgument('distance', InputArgument::REQUIRED, 'Distance in km')
            ->addArgument('time', InputArgument::REQUIRED, 'Time like hh:mm:ss ex: 01:30:00')
            ->setDescription('Cap command')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = $input->getArgument('time');
        $distance = $input->getArgument('distance');

        $speed = new Speed($distance, $time, null, new TimeConvertor());

        $tableHelper = new Table($output);
        $rows = array();
        $tableHelper->setHeaders(array('Lap (km)', 'Time (hh:mm:ss)', 'Speed: ' . $speed->getV() . ' km/h'));

        for ($i = 1; $i <= $distance; $i++) {
            $speedLap = new Speed($i, null, $speed->getV(), new TimeConvertor());
            $rows[] = array($i, $speedLap->getT());
        }

        $tableHelper->setRows($rows)->render();
    }
}
