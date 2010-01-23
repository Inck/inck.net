<?php
	if($number = $_GET['number']) {
		$paragraphs = file("pages/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$title = array_shift($paragraphs);
		$date = array_shift($paragraphs);
	} else {
		$number = "that does not exist.";
		exit;
	}
	$characters_read = $_GET['from'];

	$filler_paragraphs = file("pages/j12.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$filler_title = array_shift($filler_paragraphs);
	$filler_date = array_shift($filler_paragraphs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script type="text/javascript" src="js/Hyphenator.js" />
		<script type="text/javascript">Hyphenator.run();</script>
		<link rel="icon" href="favicon.gif">
		<link rel="stylesheet" type="text/css" href="css/library" />
		<link rel="stylesheet" type="text/css" href="css/global" />
		<link rel="stylesheet" type="text/css" href="css/modules" />
		<link rel="stylesheet" type="text/css" href="css/components" />
		<title>Inck ~ <?php if($characters_read) { echo "Continued from "; } echo $title; ?></title>
	</head>
	<body>
		<ul class="grid">
			<li class="set six_columns contained">
				<ul>
					<li class="module leader continued hyphenate">
						<h1><a href="index.php">&laquo; <?php if($characters_read) { echo "Continued from "; } echo $title; ?></a></h1>
<?php
	$characters_printing = 0;
	foreach($paragraphs as $paragraph) {
		$paragraph = $paragraph;
		if($characters_read) {
			$characters_remaining = $characters_read - $characters_printing;
			$characters_printing += strlen($paragraph);
			if($characters_printing < $characters_read) {
				echo "\t\t\t\t\t\t<p class='read'>" . $paragraph . "</p>\n";
			} elseif($characters_remaining > 0) {
				echo "\t\t\t\t\t\t<p><span class='read'>" . substr($paragraph, 0, $characters_remaining) . "</span><a name='continue'></a>" . substr($paragraph, $characters_remaining) . "</p>\n";
			} else {
				echo "\t\t\t\t\t\t<p>" . $paragraph . "</p>\n";
			}
		} else {
			echo "\t\t\t\t\t\t<p>" . $paragraph . "</p>\n";
		}
	}
?>
					</li>
				</ul>
			</li>
			<li class="set six_columns contained">
				<ul>
					<li class="module leader continued hyphenate">
<?php
		foreach($filler_paragraphs as $filler_paragraph) {
			echo "\t\t\t\t\t\t<p class='read'>" . $filler_paragraph . "</p>\n";
		}
?>
					</li>
				</ul>
			</li>
		</ul>
		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
		<script type="text/javascript">
			_uacct = "UA-2336235-2";
			urchinTracker();
		</script>
	</body>
</html>