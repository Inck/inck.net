<?php	
	if($number = $_GET['number']) {
		$paragraphs = file("pages/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$title = array_shift($paragraphs);
		$date = array_shift($paragraphs);
		$words_read = $_GET['from'];
	} else {
		$number = "that does not exist.";
		exit;
	}
	include('inc/head.php');
?>
			<li class="set three_columns contained">
				<ul>
					<li id="main_article" class="module leader continued hyphenate">
						<h1><a href="index.php"><?php if($words_read) echo "Continued from "; echo "'" . $title . "'"; ?></a></h1>
<?php
	foreach($paragraphs as $paragraph) {
		if($words_read > 0) {
			$words_read -= $words_printing;
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			if($words_printing <= $words_read) {
				echo "\t\t\t\t\t\t<p class='read'>" . $paragraph . "</p>\n";
			} elseif($words_read > 0) {
				echo "\t\t\t\t\t\t<p><a name='$number'></a><span class='read'>" . implode(' ', array_slice($words, 0, $words_read)) . "</span> " . implode(' ', array_slice($words, $words_read)) . "</p>\n";
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
			<li class="set nine_columns continued">
				<ul>
<?php
	$old_articles = array('a2', 'p5', 'j12');
	foreach($old_articles as $old_article) {
?>
					<li class="module leader read hyphenate">
<?php
		$filler_paragraphs = file("pages/$old_article.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$filler_title = array_shift($filler_paragraphs);
		$filler_date = array_shift($filler_paragraphs);
?>
						<h2>'<?php echo $filler_title; ?>'</h2>
<?php
		foreach($filler_paragraphs as $filler_paragraph) {
			echo "\t\t\t\t\t\t<p>" . $filler_paragraph . "</p>\n";
		}
?>
					</li>
<?php
	}
?>
				</ul>
			</li>
<?php
	include('inc/foot.php');
?>