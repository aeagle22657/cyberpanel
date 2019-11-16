<?php

namespace CyberPanel\Commands;

abstract class BaseCommand implements Command {

	protected $parameters;

	protected $invokingCommand;

	abstract public function run() : array;

	public function __construct(string $invokingCommand, array $parameters = []) {
		$this->invokingCommand = $invokingCommand;
		$this->parameters = $parameters;
	}

	public function buildResponse() : string {
		$rslt = json_encode([
			'command' => $this->invokingCommand,
			'response' => $this->run()
		]);
		return is_string($rslt) ? $rslt : '';
	}

	public function setInvokingCommand(string $command) : void {
		$this->invokingCommand = $command;
	}

	public function getInvokingCommand() : string {
		return $this->invokingCommand;
	}
}
