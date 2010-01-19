<?php
header("Content-Type: text/css");
$directory = opendir('.');
while($filename = readdir($directory)) {
	if(substr($filename, -4) == '.css' and substr($filename, 0, 1) != '.') {
		$handle = fopen($filename, "r");
		echo fread($handle, filesize($filename)) . "\n";
		fclose($handle);
	} elseif(substr($filename, -4) == '.php' and substr($filename, 0, 1) != '.' and $filename != "index.php") {
		include($filename);
	}
}
closedir($directory);
?>