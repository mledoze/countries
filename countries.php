#!/usr/bin/env php
<?php
require_once "vendor/autoload.php";

/**
 * Tools to convert countries in different formats
 * @author mledoze
 * @see https://github.com/mledoze/countries
 * @require PHP 5.4+
 */

use MLD\Console\Command\ExportCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new ExportCommand(
	__DIR__ . DIRECTORY_SEPARATOR . 'countries.json',
	__DIR__ . DIRECTORY_SEPARATOR . 'dist'
));
$application->run();