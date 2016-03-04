<?php
	date_default_timezone_set('GMT');
	$edition = "Dark Financial Times Edition";
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
	<title>The Inck Some Times ~ <?php echo $title; ?></title>
	<!--[if lt IE 9]]><script type="text/javascript" src="js/scold.js"></script><![endif]-->
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
	<script src="http://fast.fonts.net/jsapi/e217dff1-f657-4cb5-a930-1af06e484bac.js"></script>
	<script src="js/lib/jquery.min.js"></script>
	<script src="js/flow.js"></script>
	<script src="js/show.js"></script>
	<script>
		$.ajax({
			url:'https://api.github.com/repos/Inck/inck.net/commits',
			dataType: 'json',
			success:function(data){
				var commit = data[0].sha;
				$('#commit_link').text('Commit '+commit.substring(0, 6)).attr('href', 'https://github.com/Inck/inck.net/commit/'+commit);
			}
		});

		$.ajax({
			url:'https://api.github.com/repos/Inck/inck.net/issues?state=open&direction=asc',
			dataType: 'json',
			success:function(data){
				var issue = data.shift().number
				$('#issue_link').text('Issue '+issue).attr('href', 'https://github.com/Inck/inck.net/issues/'+issue);
			}
		});
	</script>
</head>
<body>
	<div id="page">
		<a id="top"></a>
		<ul id="grid">
