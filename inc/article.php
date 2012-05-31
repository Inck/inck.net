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
	$text = implode('', $lines);
	$paragraphs = explode("\n\n", $text);
	if($jump) {
		$jump_words = explode(' ', $text);
		$jump_truncation = array_slice($jump_words, 0, $jump);
		$text = implode(' ', $jump_truncation);
		$paragraphs = explode("\n\n", $text);
		$current = 1;
		$last = count($paragraphs);
	}
?>
<?php echo $indent; ?><article>
<?php $indent .= "\t"; ?>
<?php echo $indent; ?><h2><a href="page.php?number=<?php echo $page; ?>"><?php echo $title; ?></a></h2>
<?php echo $indent; ?><cite>Revised by <a href="http://twitter.com/#!/inck">Nicholas Hall</a> on <em><?php echo $date; ?></em></cite>
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
			echo ", with " . $words[$number_of_letters];
			echo " Letter";
			if($number_of_letters != 1) echo "s";
			echo " to the Editor";
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