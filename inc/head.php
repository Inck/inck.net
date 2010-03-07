<?php
	error_reporting(0);
	$words = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="icon" href="favicon.gif" />
		<link rel="stylesheet" type="text/css" href="css/library" />
		<link rel="stylesheet" type="text/css" href="css/global" />
		<link rel="stylesheet" type="text/css" href="css/modules" />
		<link rel="stylesheet" type="text/css" href="css/components" />
		<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/inck" title="RSS" />	
		<title>Inck ~ <?php if($characters_read) { echo "Continued from "; } echo $title; ?></title>
		<!--[if IE]>
		<script type="text/javascript">
			alert("Hey there old timer! This website doesn't work very well in Internet Explorer, or Windows for that matter. Try Safari, Chrome or Firefox. I don't figure you'll switch to a Macs on my account, but you know, you really aught to for your own sake.");
		</script>
		<![endif]-->
<?php
print_r($_GET);
	if(isset($_GET['hyphenate'])) {
?>
		<script type="text/javascript" src="lib/hyphenator/Hyphenator.js"></script>
<?php
	}
?>
		<!--<script type="text/javascript" src="lib/prototype.js"></script>-->
		<script type="text/javascript">
			function endRun() {
				// Hyphenate articles.
				Hyphenator.run();
				
				// Flow articles into columns.
				// var article1column1 = document.getElementById("top_right_one");
				// var article1column2 = document.getElementById("top_right_two");
				// var article1column3 = document.getElementById("top_right_three");
				
				// document.getElementById("main_article").height;
			}
		</script>
	</head>
	<body>
		<div><a name="top"></a></div>
		<ul class="grid">
