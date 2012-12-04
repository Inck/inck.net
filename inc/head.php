<?php
	error_reporting(0);
	$words = array("no", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty");
	$edition = "Volume Three, Issue One";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="img/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="css/lib" />
	<link rel="stylesheet" type="text/css" href="css/global" />
	<link rel="stylesheet" type="text/css" href="css/modules" />
	<link rel="stylesheet" type="text/css" href="css/elements" />
	<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/inck/" title="RSS" />
	<title>Inck ~ <?php echo $title; ?></title>
	<!--[if lt IE 9]]><script type="text/javascript" src="js/scold.js"></script><![endif]-->
	<script src="js/lib/hyphenator/Hyphenator.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/flow.js"></script>
	<script src="js/show.js"></script>
	<script> Hyphenator.run(); </script>
</head>
<body>
	<div id="page">
		<a id="top"></a>
		<ul id="grid">
