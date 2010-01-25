<?php
	if($number = $_GET['number']) {
		$paragraphs = file("pages/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$title = array_shift($paragraphs);
		$date = array_shift($paragraphs);
	} else {
		$number = "that does not exist.";
		exit;
	}
	$words_read = $_GET['from'];

	$filler_paragraphs = file("pages/j12.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$filler_title = array_shift($filler_paragraphs);
	$filler_date = array_shift($filler_paragraphs);
	
	include('inc/head.php');
?>
			<li class="set six_columns contained">
				<ul>
					<li class="module leader continued hyphenate">
						<h1><a href="index.php">Continued from '<?php echo $title; ?>'</a></h1>
<?php
	$words_printing = 0;
	foreach($paragraphs as $paragraph) {
		if($words_read > 0) {
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			$words_read -= $words_printing;
			if($words_printing < $words_read) {
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
			<li class="set six_columns">
				<ul>
					<li class="module leader continued hyphenate">
						<h1><?php echo $filler_title; ?></h1>
<?php
	foreach($filler_paragraphs as $filler_paragraph) {
		echo "\t\t\t\t\t\t<p>" . $filler_paragraph . "</p>\n";
	}
?>
					</li>
				</ul>
			</li>
<?php
	include('inc/foot.php');
?>