<?php

namespace CyberPanel\System\ShellCommands;

interface Media {

	// phpcs:disable Generic.Files.LineLength
	const CMD_VOLUME = "pactl list sinks | grep '^[[:space:]]Volume:' | head -n 1 |sed -e 's,.* \\([0-9][0-9]*\\)%.*,\\1,'";

	const CMD_GETPLAYERS = "qdbus | egrep -i 'org.mpris.MediaPlayer'";

	const CMD_CURRENTSONG = "qdbus `qdbus | egrep -i 'org.mpris.MediaPlayer'`  /org/mpris/MediaPlayer2 org.mpris.MediaPlayer2.Player.Metadata";
	const CMD_CURRENTPOSITION = "qdbus `qdbus | egrep -i 'org.mpris.MediaPlayer'`  /org/mpris/MediaPlayer2 org.mpris.MediaPlayer2.Player.Position";
	// phpcs:enable

}
