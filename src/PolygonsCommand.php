<?php
namespace Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class PolygonsCommand extends Command
{
    protected function configure()
    {
        $this->setName('sortPolygons')
            ->setDescription('sorting polygons using data from JSON file')            
            ->setHelp('To manage this console app to work, you must set exact JSON filename as an argument.')
            ->addArgument('file_path_to_JSON_file', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->sortPolygons($input, $output);
    }
}
?>