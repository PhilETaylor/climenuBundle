<?php

namespace Philetaylor\ClimenuBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

class ClimenuCommand extends Command
{
	static $output;
	static $env;

	protected function configure()
	{
		$this->setName('cli:menu')
			->setDescription('Starts the menu.')
			->setHelp('This command allows you to access commands easier...');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		self::$output = $output;
		self::$env = 'dev';

		$menu = (new CliMenuBuilder)
			->setTitle('Symfony Basic CLI Menu (Env = ' . ClimenuCommand::$env . ')')
			->addItem('Symfony Clear Cache With No Warmup', function (CliMenu $menu) {
				ClimenuCommand::$output->writeln(passthru(sprintf('php bin/console -env=%s cache:clear --no-warmup', ClimenuCommand::$env)));
				$flash = $menu->flash("!!!DONE!!!");
				$flash->getStyle()->setBg('green');
				$flash->display();
			})
			->addItem('Doctrine Clear Cache & Schema Force Update', function (CliMenu $menu) {
				echo passthru(sprintf('php bin/console -env=%s doctrine:cache:clear-metadata', ClimenuCommand::$env));
				echo passthru(sprintf('php bin/console -env=%s doctrine:schema:update --force', ClimenuCommand::$env));
				$flash = $menu->flash("!!!DONE!!!");
				$flash->getStyle()->setBg('green');
				$flash->display();
			})
			->addLineBreak('-')
			->build();

		$menu->open();
	}
}