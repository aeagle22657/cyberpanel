<?php

namespace CyberPanel\Macros;

class MacroParser {

	private static self $instance;

	private function __construct() {
	}

	public static function getInstance() : self {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return  self::$instance;
	}

	public function parse(array $data) : Macro {
		$macro = new Macro();
		if (array_key_exists('delimiter', $data)) {
			$macro->setisDelimiter();
		} else {
			if (array_key_exists('caption', $data)) $macro->setCaption($data['caption']);
			if (array_key_exists('command', $data)) $macro->setCommand($data['command']);
			if (array_key_exists('icon', $data)) $macro->setIcon($data['icon']);
		}
		return $macro;
	}
}
