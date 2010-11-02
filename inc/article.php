<?php for($i=$indent;$i;$i--) echo "\t"; ?><article>
<?php
	$paragraphs = file("pages/$article.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$title = array_shift($paragraphs);
	$date = array_shift($paragraphs);
	$lede = explode(' -- ', $paragraphs[0]);
	$indent++; // Accommodate indent of article tag.
	if($lede[1]) { // If there was a dateline.
		$dateline = $lede[0];
		$paragraphs[0] = $lede[1];
	}
?>
<?php for($i=$indent;$i;$i--) echo "\t"; ?><h2><a href="page.php?number=<?php echo $article; ?>"><?php echo $title; ?></a></h2>
<?php for($i=$indent;$i;$i--) echo "\t"; ?><cite>by Nicholas Hall on <em><?php echo $date; ?></em></cite>
<?php
	if($jump) {
		$jump_text = implode("\n ", $paragraphs);
		$jump_words = explode(" ", $jump_text);
		$jump_truncation = array_slice($jump_words, 0, $jump);
		$jump_text = implode(" ", $jump_truncation);
		$paragraphs = explode("\n", $jump_text);
		$current = 1;
		$last = count($paragraphs);
		$page = strtoupper($article);
	}
	
	foreach($paragraphs as $paragraph) {
?>
<?php for($i=$indent;$i;$i--) echo "\t"; ?><p><?php if($dateline) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph; ?><?php if($jump and $current == $last) { echo "… <a href=\"page.php?number=$article&amp;from=$jump#$article\" class=\"jumpline\">Continued, with Letters to the Editor, on Page $article »</a>"; } else { $current++; } ?></p>
<?php
	}
	
	if(!$jump) {
		$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/$article.txt"))) - 1;
		if($number_of_letters) {
?>
<?php for($i=$indent;$i;$i--) echo "\t"; ?><p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this article.) <a href="page.php?number=<?php echo $article; ?>#top">Read them.</a></p>
<?php
		} else {
?>
<?php for($i=$indent;$i;$i--) echo "\t"; ?><p class="letters">(There are currently no Letters to the Editor in response to this article.) <a href="page.php?number=<?php echo $article; ?>#top">Write one</a>.</p>
<?php
		}
	}
?>
<?php $indent--;for($i=$indent;$i;$i--) echo "\t"; ?></article>
