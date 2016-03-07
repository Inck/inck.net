<?php
header("Content-Type: text/css");
?>
/*
	Inck is set in fourteen pixel Hoefler
	Text if viewed on a Mac. The grid is 
	twelve hundred pixels divided into 
	twelve columns of eighty pixels each 
	with twenty pixel gutters. The 
	baseline grid is twenty-one pixels. 
	The text is printed in black, on acid-
	free rgb(242, 231, 233).
*/

<?php
$directory = opendir('.');
while($filename = readdir($directory)) {
	if(substr($filename, -4) == '.css' and substr($filename, 0, 1) != '.') {
		$handle = fopen($filename, "r");
		echo "/* " . $filename . " */\n" . fread($handle, filesize($filename)) . "\n";
		fclose($handle);
	} elseif(substr($filename, -4) == '.php' and substr($filename, 0, 1) != '.' and $filename != "index.php") {
		echo "/* " . $filename . " */\n";
		include($filename);
	}
}
closedir($directory);
?>