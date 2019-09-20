#!/usr/bin/env php
<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use Symfony\Component\Console\Application;
    use Console\PolygonsCommand;

    $app = new Application('PolygonsSort', '1.0.0');
    $app->add(new PolygonsCommand());
    $app->run();
?>