<?php

namespace CyberPanel\Configuration;

use Symfony\Component\Yaml\Yaml;

class ConfigurationLoader {
	public static function load(
		Configuration $configuration,
		string $fileName = 'config.yml'
	) : void {
		$yaml = Yaml::parseFile($fileName);
		$macroList = new MacroList();
		foreach ($yaml['macros'] as $macro) {
			$macroList->addMacro(
				self::parseMacro($macro)
			);
		}
		$configuration->addMacroList($macroList);
	}

	private static function parseMacro(array $data) : Macro {
		$macro = new Macro();
		if (array_key_exists('caption', $data)) $macro->setCaption($data['caption']);
		if (array_key_exists('command', $data)) $macro->setCommand($data['command']);
		if (array_key_exists('icon', $data)) $macro->setIcon($data['icon']);
		return $macro;
	}

}
