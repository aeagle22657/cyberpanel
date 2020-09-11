<?php

namespace CyberPanel\Server;

use  React\Http\Message\Response;;
use React\EventLoop\Factory;
use React\Http\Server;
use Psr\Http\Message\ServerRequestInterface;
use CyberPanel\Server\Utils\Mime;

class WebServer  {

	protected $port;

	protected $baseDir = 'build/';

	public function __construct(int $port = 8082) {
		$this->port = $port;
	}

	public function run() {
		$loop = Factory::create();
		$server = new Server($loop, function (ServerRequestInterface $request) {
			return $this->handleRequest($request);
		});
		$socket = new \React\Socket\Server('0.0.0.0:' . $this->port, $loop);
		$server->listen($socket);
		$loop->run();
	}

	protected function handleRequest(ServerRequestInterface $request) : Response {
		$uri = $request->getUri()->getPath();
		$file = $this->getFullFilePath($uri);
		if (file_exists($file)) {
			return new Response(
				200,
				[Mime::getContentType($file)],
				file_get_contents($file)
			);
		} elseif ($uri == '/config.js') {
			return new Response(
				200,
				[Mime::getContentType($uri)],
				include __DIR__ . '/tpl/config.js.php'
			);
		}
	}

	protected function getFullFilePath(string $file) : string {
		if ($file == '/') {
			$file = 'index.html';
		}
		return realpath($this->baseDir . $file);
	}


}