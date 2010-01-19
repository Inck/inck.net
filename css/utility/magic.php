<?

/**
* 
* @package utilities
*
* Magic.php, Renovation v1
* Copyright 2008 The Wall Street Jorunal
* by Erin Sparling, erin.sparling at wsj.com
* Debugged by Hani Lim and Mike Stamm
*
* This file looks for a file specified in the $config['defaultCSS'] variable.  
* This CSS file should contain only @import url(file) statements of other css files.
* These secondary css files should not contain @imports themselves, as the file-handling
* isn't currently recursive.
*
* This file takes the @imported css files, compresses them using the compress() function,
* then outputs them to the browser.  This file can then be saved to form your compressed 
* concatenated css file.
*
* This file contains two $_GET overrides, filename= and exclude=.
* filename= is used to read an alternate main css import file, which can be used for
* testing or developmetn.  exclude= takes a comma-separated list of files to not include
* in the output, regardless of their presence in the main css import file.
*
* To automate this process, one can use curl from the terminal. For example:
* curl http://localhost/css/wsjmain.css -o ~/Desktop/wsjmain-flat.css
**/

//default css file
$config['defaultCSS'] = "wsjmain.css";

//default cdn
$CDNimg = "../img";


//compression function from http://websitetips.com/articles/optimization/css/crunch/
function compress($buffer) {

	/* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

	/* remove tabs, spaces, new lines, etc. */        
    // $buffer = str_replace(array("\r\n", "\r", "\n", "\t", ' ', '    ', '    '), '', $buffer);

	/* temporary replacement modification that does not remove 3, 4 and 5-strings of spaces */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);

	/* replace all multi-space strings with a single-space */
    $buffer = str_replace(array(' ', '    ', '    '), ' ', $buffer);

	/* remove unnecessary spaces */        
    $buffer = str_replace('{ ', '{', $buffer);
    $buffer = str_replace(' }', '}', $buffer);
    $buffer = str_replace('; ', ';', $buffer);
    $buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' {', '{', $buffer);
    $buffer = str_replace('} ', '}', $buffer);
    $buffer = str_replace(': ', ':', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    $buffer = str_replace(' ;', ';', $buffer);
	return $buffer;
}

//set the CDN
	if(isset($_GET['cdn'])) {
		$CDNimg = $_GET['cdn'];
	}

// get contents of the master css file into an array

	//determine if a custom file is asking to be loaded
	//accepts a string of files as a variable, in the form of file.php?filename=alternateCSS.css
	if((isset($_GET['filename'])) && is_file($_GET['filename'])) {
		//File was found, process it
		$filename = $_GET['filename'];
	} elseif(empty($_GET['filename'])) {
		// no get value passed, revert to default
		$filename = $config['defaultCSS'];
	} else {
		// incorrect filename passed, revert to default
		$filename = $config['defaultCSS'];
	}
	
	//determine if any files are to be excluded from importing.
	//accepts a string of files as a variable, in the form of file.php?exclude=exclude1.css,exclude1.css,exclude3.css
	if((isset($_GET['exclude'])) && (empty($_GET['exclude']) != TRUE)) {
		//File was found, process it
		$exclude = $_GET['exclude'];
		$excluded = array();
		$exploding = explode(',', $exclude);

		foreach($exploding as $exploded) {
			if(is_file($exploded)) {
				$excluded[] = $exploded; 
			}
		}

	} elseif(empty($_GET['exclude'])) {
		// no get value passed, revert to default
		$excluded = array();
	} else {
		// incorrect filename passed, revert to default
		$excluded = array();
	}

	$handle = file($filename);

	//setup the variable for concatenation
	$output = NULL;

	//iterate through the array
	foreach($handle as $fileString) {
	
		//strip out the unnecessary characters from the @import url("file.css");
		//Thanks Joel Young @ Apple for the Regex.
		preg_match('/\(\"?([^\)\"]+)\"?\)/', $fileString, $file);
		@$file = $file[1];

		//if the line isn't blank, echo the contents of the file
		if(($file != "") && (in_array($file, $excluded) == FALSE)) {
			$fileContents = @fopen($file, "r");
			$contents = @fread($fileContents, filesize($file));
			// echo $contents . "\r\n";

			//replace the image url with the cd override if necessary
			
			//replace the image url with the cd override if necessary
			$contents = str_replace("../../build/img", "tempstring0", $contents);
			$contents = str_replace("../../img", "tempstring12", $contents);
			$contents = str_replace("../img", "tempstring1", $contents);
			$contents = str_replace("/img", "tempstring2", $contents);
			$contents = str_replace("'img/", "tempstring3", $contents);
			$contents = str_replace("\"img/", "tempstring4", $contents);
			$contents = str_replace("(img/", "tempstring5", $contents);
					
			$contents = str_replace("tempstring0", "$CDNimg", $contents);
			$contents = str_replace("tempstring12", "$CDNimg", $contents);
			$contents = str_replace("tempstring1", "$CDNimg", $contents);
			$contents = str_replace("tempstring2", "$CDNimg", $contents);
			$contents = str_replace("tempstring3", "'$CDNimg/", $contents);
			$contents = str_replace("tempstring4", "\"$CDNimg/", $contents);
			$contents = str_replace("tempstring5", "($CDNimg/", $contents);
			
			$output .= $contents; 
		
			@fclose($fileContents);
		}
	}
	
	
	
	
	
	// echo $output;
	echo compress($output);
	echo "\r\n/* This file was built from wsjmain's magic.php on " . date('l jS \of F Y h:i:s A') . "*/";
	
?>