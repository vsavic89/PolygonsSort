<?php
namespace Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class PolygonsCommand extends Command
{
    protected function configure()
    {
        $this->setName('sortPolygons')
            ->setDescription('sorting polygons using data from JSON file');
            // ->setHelp('');
            //->addArgument()
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->sortPolygons($input, $output);
    }
}
?>