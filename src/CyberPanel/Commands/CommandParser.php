<?php

namespace CyberPanel\Commands;

use CyberPanel\Commands\Commands\DateTimeCommand;
use CyberPanel\Commands\Commands\SystemInfoCommand;
use CyberPanel\Commands\Commands\LoadMacrosCommand;
use CyberPanel\Commands\Commands\RunMacroCommand;
use CyberPanel\Commands\Commands\KeyboardCommand;
use CyberPanel\Commands\Commands\MediaCommand;
use CyberPanel\Commands\Commands\LockScreenImageCommand;

class CommandParser {

	private static $instance;

	private $commands = [];

	private function __construct() {
		$this->registerCommand('datetime', DateTimeCommand::class);
		$this->registerCommand('systeminfo', SystemInfoCommand::class);
		$this->registerCommand('loadmacros', LoadMacrosCommand::class);
		$this->registerCommand('macro', RunMacroCommand::class);
		$this->registerCommand('keyboard', KeyboardCommand::class);
		$this->registerCommand('media', MediaCommand::class);
		$this->registerCommand('lockscreenimage', LockScreenImageCommand::class);
	}

	public static function getInstance() : CommandParser {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function parse($commandQuery) : array {
		if (!is_array($commandQuery)) {
			$commandQuery = [$commandQuery];
		}
		$commands = [];
		foreach ($commandQuery as $commandQuery) {
			if (
				!empty($commandQuery->command)
				&& array_key_exists($commandQuery->command, $this->commands)
			) {
				$command = new $this->commands[$commandQuery->command](
					$commandQuery->command,
					!empty($commandQuery->parameters) ? $commandQuery->parameters : []
				);
				$commands[] = $command;
			}
		}
		return $commands;
	}

	public function registerCommand(string $command, string $class) : void {
		$this->commands[$command] = $class;
	}
}
