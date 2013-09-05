#!/usr/bin/env php
<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2013 Marco Graetsch <magdev3.0@googlemail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author magdev
 * @copyright 2013 Marco Graetsch <magdev3.0@googlemail.com>
 * @package
 *
 * @license http://opensource.org/licenses/MIT MIT License
 */

use Silex\Application;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$app = new Silex\Application();

// Instantiate our Console application
$console = new ConsoleApplication('Silex Solr-Tool', '0.1');

// Register a command to run from the command line
// Our command will be started with "./console.php sync"
$console->register('index')
	->setDefinition(array(
		new InputOption 'test', '', InputOption::VALUE_NONE, 'Test mode')
	))
	->setDescription('(re-)create indexes')
	->setHelp('Usage: <info>./solr.php index [--test]</info>')
	->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
		if ($input->getOption('test')) {
			$output->write("\n\tTest Mode Enabled\n\n");
		}
	
		// @todo implement indexing
	});

$console->run();