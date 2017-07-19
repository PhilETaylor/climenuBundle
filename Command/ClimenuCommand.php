<?php

namespace Philetaylor\ClimenuBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

class ClimenuCommand extends Command
{
	protected function configure()
	{
		$this
			// the name of the command (the part after "bin/console")
			->setName('bf:menu')

			// the short description shown while running "php bin/console list"
			->setDescription('Shows the menu')

			// the full command description shown when running the command with
			// the "--help" option
			->setHelp('This command allows you to visually select menu items')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$itemCallable = function (CliMenu $menu) {
			echo $menu->getSelectedItem()->getText();
		};

		$menu = (new CliMenuBuilder)
			->setTitle('Basic CLI Menu')
			->addItem('First Item', $itemCallable)
			->addItem('Second Item', $itemCallable)
			->addItem('Third Item', $itemCallable)
			->addLineBreak('-')
			->build();

		$menu->open();
	}
}