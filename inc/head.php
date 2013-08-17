<?php
	date_default_timezone_set('GMT');
	$commit = `git rev-parse HEAD`;
	$truncated_commit = substr($commit, 0, 8);
	$issue = 1; // Get lowest-number open issue from GitHub API.
	$edition = "Volume <a href='https://github.com/Inck/inck.net/commit/$commit'>$truncated_commit</a>, <a href='https://github.com/Inck/inck.net/issues/$issue'>Issue $issue</a>";
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/flow.js"></script>
	<script src="js/lib/hyphenator/Hyphenator.js"></script>
	<script> Hyphenator.run(); </script>
	<script src="js/show.js"></script>
</head>
<body>
	<div id="page">
		<a id="top"></a>
		<ul id="grid">
