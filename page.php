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
	
	include('includes/head.php');
?>
			<li class="set six_columns contained">
				<ul>
					<li class="module leader continued hyphenate">
						<h1><a href="index.php">Continued from '<?php echo $title; ?>'</a></h1>
<?php
	$words_printing_total = 0;
	foreach($paragraphs as $paragraph) {
		if($words_read_printing > 0) {
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			$words_read -= $words_printing;
			if($words_printing < $words_read) {
				echo "\t\t\t\t\t\t<p class='read'>" . $paragraph . "</p>\n";
			} elseif($words_remaining > 0) {
				echo "\t\t\t\t\t\t<p><a name='continue'></a><span class='read'>" . substr($paragraph, 0, $characters_remaining) . "</span>" . substr($paragraph, $characters_remaining) . "</p>\n";
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
	include('includes/foot.php');
?>