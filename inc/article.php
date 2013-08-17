<?php
	// ToDo: Truncation is happening a few words long. 187 instead of 185, 255 instead of 250, 265 instead of 260. Fix this bullshit.
	$lines = file("pages/$page.txt", FILE_TEXT);
	$title = trim(array_shift($lines));
	$date = trim(array_shift($lines));
	$lede = explode(' -- ', $lines[1]);
	if($lede[1]) { // If there was a dateline.
		$dateline = trim($lede[0]);
		$lines[1] = $lede[1];
	}

	// Make a truncated copy of the article paragraphs array.
	$paragraphs = array();
	if($jump) {
		$words_to_jump = $jump;
		foreach($lines as $paragraph) {
			if(isset($paragraph[1])) {
				$paragraph = trim($paragraph);
				if(isset($words_to_jump) and $words_to_jump > 0) {
					$paragraph_words = explode(' ', $paragraph);
					$words_printing = count($paragraph_words);
					if($words_printing <= $words_to_jump) { // If this paragraph is all printing.
						$paragraphs[] = $paragraph;
					} elseif($words_to_jump > 0) { // If this paragraph is partially printing.
						$paragraphs[] = implode(' ', array_slice($paragraph_words, 0, $words_to_jump));
					}
				}
				$words_to_jump -= $words_printing;
			}
		}
		$current = 1;
		$last = count($paragraphs);
	} else {
		$paragraphs = explode("\n\n", $text);
	}
?>
<?php echo $indent; ?><article>
<?php $indent .= "\t"; ?>
<?php echo $indent; ?><h2><a href="page.php?number=<?php echo $page; ?>"><?php echo $title; ?></a></h2>
<?php echo $indent; ?><cite>edited by <a href="http://twitter.com/#!/inck">Nicholas Hall</a> on <em><?php echo $date; ?></em></cite>
<?php	
	foreach($paragraphs as $paragraph) {
		$paragraph = trim($paragraph);
?>
<?php echo $indent; ?><p><?php 
		if($dateline) {
			echo "<span class=\"dateline\">$dateline</span>";
			unset($dateline);
		}

		// If there are linebreaks and no HTML.
		if(preg_match("|\n|", $paragraph) and !preg_match("|</|", $paragraph)) {
			$lines = explode("\n", $paragraph);
			echo array_shift($lines);
			foreach($lines as $line) {
				echo "<br />\n";
				echo $indent . $line;
			}
		} else {
			echo trim($paragraph);
		}

		if($jump and $current == $last) {
			$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/$page.txt"))) - 1;
			echo "… <a href=\"page.php?number=$page&amp;from=$jump#$page\" class=\"jumpline\">continued";
			if($number_of_letters) {
				echo " with " . $words[$number_of_letters];
				echo " Letter";
				if($number_of_letters != 1) echo "s";
				// echo " to the Editor";
			}
			echo " »</a>";
		} else {
			$current++;
		} ?></p>
<?php
	}
?>
<?php $indent = substr($indent, 1); ?>
<?php echo $indent; ?></article>
<?php $indent = substr($indent, 1); ?>
<?php echo $indent; ?>
<?php $indent .= "\t"; ?>