<?php
	error_reporting(0);
	$words = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="icon" href="img/favicon.gif" />
		<link rel="stylesheet" type="text/css" href="css/lib" />
		<link rel="stylesheet" type="text/css" href="css/inck" />
		<link rel="stylesheet" type="text/css" href="css/clips" />
		<link rel="stylesheet" type="text/css" href="css/blocks" />
		<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/inck/" title="RSS" />
		<title>Inck ~ <?php if(isset($characters_read)) { echo "Continued from "; } echo $title; ?></title>
		<!--[if IE]>
		<script type="text/javascript" src="js/scold.js"></script>
		<![endif]-->
<?php
	if(isset($_GET['hyphenate'])) {
?>
		<script type="text/javascript" src="js/lib/hyphenator/Hyphenator.js"></script>
		<script type="text/javascript"> Hyphenator.run(); </script>
<?php
	}
?>
		<script type="text/javascript" src="js/lib/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/flow.js"></script>
	</head>
	<body>
		<div><a name="top"></a></div>
		<ul class="grid">
