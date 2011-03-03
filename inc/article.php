<?php
	$lines = file("pages/$article.txt", FILE_TEXT);
	$title = trim(array_shift($lines));
	$date = trim(array_shift($lines));
	$lede = explode(' -- ', $lines[0]);
	if($lede[1]) { // If there was a dateline.
		$dateline = trim($lede[0]);
		$lines[0] = $lede[1];
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
		$page = strtoupper($article);
	}
?>
<?php echo $indent; ?><article>
<?php $indent .= "\t"; ?>
<?php echo $indent; ?><h2><a href="page.php?number=<?php echo $article; ?>"><?php echo $title; ?></a></h2>
<?php echo $indent; ?><cite>by Nicholas Hall on <em><?php echo $date; ?></em></cite>
<?php	
	foreach($paragraphs as $paragraph) {
		$paragraph = trim($paragraph);
?>
<?php echo $indent; ?><p><?php 
		if($dateline) {
			echo "<span class=\"dateline\">$dateline</span>";
			unset($dateline);
		}

		// If there are linebreaks.
		if(preg_match("|\n|", $paragraph)) {
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
			echo "… <a href=\"page.php?number=$article&amp;from=$jump#$article\" class=\"jumpline\">Continued, with Letters to the Editor, on Page $article »</a>";
		} else {
			$current++;
		} ?></p>
<?php
	}
	
	if(!$jump) {
		$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/$article.txt"))) - 1;
		if($number_of_letters) {
?>
<?php echo $indent; ?><p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this.) <a href="page.php?number=<?php echo $article; ?>#top">Read them.</a></p>
<?php
		} else {
?>
<?php echo $indent; ?><p class="letters">(There are currently no Letters to the Editor in response to this.) <a href="page.php?number=<?php echo $article; ?>#top">Write one</a>.</p>
<?php
		}
	}
?>
<?php echo substr($indent, 1); ?></article>
