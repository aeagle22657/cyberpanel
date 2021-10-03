<?php

namespace CyberPanel\Voice;

use CyberPanel\Events\EventManager;
use CyberPanel\Voice\Listeners\ApplicationStartedListener;
use CyberPanel\Voice\Listeners\TerminalConnections\TerminalConnectedListener;
use CyberPanel\Voice\Listeners\TerminalConnections\TerminalDisconnectedListener;
use CyberPanel\Voice\Listeners\TerminalConnections\TerminalUnauthorizedListener;
use CyberPanel\Voice\Listeners\Hardware\CpuTemperatureWarnListener;
use CyberPanel\Voice\Listeners\Hardware\GpuTemperatureWarnListener;
use CyberPanel\Commands\CommandResolver;
use CyberPanel\Voice\Commands\EnableSpeakerCommand;

class VoiceSubmodule {

	private function __construct() {
	}

	public static function init() : void {
		self::initListeners();
		self::initCommands();
	}

	protected static function initListeners() : void {
		EventManager::getInstance()->registerListener(ApplicationStartedListener::class);
		EventManager::getInstance()->registerListener(TerminalConnectedListener::class);
		EventManager::getInstance()->registerListener(TerminalDisconnectedListener::class);
		EventManager::getInstance()->registerListener(TerminalUnauthorizedListener::class);

		EventManager::getInstance()->registerListener(GpuTemperatureWarnListener::class);
		EventManager::getInstance()->registerListener(CpuTemperatureWarnListener::class);
	}

	protected static function initCommands() : void {
		CommandResolver::getInstance()->registerCommand(
			'speakerEnable',
			EnableSpeakerCommand::class
		);
	}



}
