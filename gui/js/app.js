/* global Vue, socket, dateTimeWidget, keyboardWidget, systemInfoWidget, intervalCommandRunner, macrosWidget */
var cyberPanel;
var mixins = [];

document.addEventListener('DOMContentLoaded', function() {

	cyberPanel = new Vue({
		el: '#cyberPanel',
		mixins: mixins,
		data: {
			datetime: {
				date: '',
				time: '',
				holiday: ''
			},
			systemInfo: {
				cpuLoad: 40,
				memory: {
					used: 100,
					total: 1000
				},
				temperatures: {
					cpu: 100,
					gpu: 100
				},
				storages: []
			},
			keyboard: {
				numlock: 'off',
				capslock: 'off',
				scrolllock:'off'
			},
			macros: [],
			noSleep: false,
			fullScreen: false
		},
		delimiters: ['<%', '%>']
	});

	
	socket.open();
	intervalCommandRunner.registerRunner(1000, 'datetime', dateTimeWidget.handle);
	intervalCommandRunner.registerRunner(1000, 'systeminfo', systemInfoWidget.handle);
	intervalCommandRunner.registerRunner(400, 'keyboard', keyboardWidget.handle);
	
	socket.registerHandler('loadmacros', macrosWidget.handle);
	setTimeout( function() {socket.send('loadmacros', 123);},1000);
	
});