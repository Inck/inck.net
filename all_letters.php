<?php
	error_reporting(0);
	$directory = opendir('letters');
	while($filename = readdir($directory)) {
		if($filename[0] != ".") {
			$letters_together = file_get_contents('letters/' . $filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			echo "<h2>$filename</h2><pre>".print_r($letters_together, true)."</pre>";
		}
	}
?>