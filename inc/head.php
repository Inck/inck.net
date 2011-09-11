<?php
	error_reporting(0);
	$words = array("no", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty");
	$edition = "Volume Two, Issue Three";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="UTF-8"/>
	<link rel="icon" href="img/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="css/lib" />
	<link rel="stylesheet" type="text/css" href="css/inck" />
	<link rel="stylesheet" type="text/css" href="css/clips" />
	<link rel="stylesheet" type="text/css" href="css/modules" />
	<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/inck/" title="RSS" />
	<title>Inck ~ <?php if(isset($characters_read)) { echo "Continued from "; } echo $title; ?></title>
	<!--[if lt IE 9]]><script type="text/javascript" src="js/scold.js"></script><![endif]-->
	<script src="js/lib/hyphenator/Hyphenator.js"></script>
	<script src="js/lib/jquery-1.3.2.min.js"></script>
	<script src="js/flow.js"></script>
	<script src="js/show.js"></script>
	<script> Hyphenator.run(); </script>
</head>
<body>
	<div id="page">
		<a id="top"></a>
		<ul id="grid">
