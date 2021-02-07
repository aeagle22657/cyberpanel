/* global cyberPanel, sound, config */
var systemInfoWidget = {
	handle: function(data) {
		cyberPanel.systemInfo = data;
		if (
			config.hwLimits.cpu.temperature < cyberPanel.systemInfo.temperatures.cpu
			|| config.hwLimits.gpu.temperature < cyberPanel.systemInfo.temperatures.gpu
		) {
			sound.playAlert();
		}
	},
};