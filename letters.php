<?php
	$title = "Letters to the Editor";
	include('inc/head.php');
	
	// ToDo: Limit to a1 articles.
	// Get article list from feed.
	$feed_xml = `php feed.php`;
	$feed = new SimpleXMLElement($feed_xml);
	$article_numbers[] = substr($feed->channel->item[0]->guid, 32);
	$article_numbers[] = substr($feed->channel->item[1]->guid, 32);
	$article_numbers[] = substr($feed->channel->item[2]->guid, 32);
	$article_numbers[] = substr($feed->channel->item[3]->guid, 32);
?>
			<li class="column one_unit">
				<ul>
					<li class="block flag secondary">
						<h3><a href="./"><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></a></h3>
					</li>
				</ul>
			</li>
			<li class="space nine_units"></li>
			<li class="column two_units">
				<ul>
					<li class="block edition secondary">
						<cite><?php echo $edition; ?></cite>
						<cite>Letters to the Editor</cite>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="block rule"></li>
				</ul>
			</li>
<?php
	foreach($article_numbers as $key => $article_number) {
?>
			<li class="column three_units<?php if(!$key) echo ' contained'; ?>">
				<ul>
<?php
		$article = file_get_contents('pages/' . $article_number . '.txt'); $lines = explode("\n", $article);
		$article_title = trim($lines[0]);
		$article_date = trim($lines[1]);
?>
					<li class="block leader contained">
						<h2><a href="page.php?number=<?php echo $article_number; ?>"><?php echo $article_title; ?></a></h2>
						<cite>by Nicholas Hall on <em><?php echo $article_date; ?></em></cite>
					</li>
<?php
		if($letters_together = file_get_contents('letters/' . $article_number . '.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) {
			$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
			foreach($letters as $letter) {
				$lines = explode("\n", $letter);
				$time = array_shift($lines);
				$name = array_pop($lines);
?>
					<li class="block letter_box two_units">
						<ul>
							<li class="block leader letter">
								<em><?php if(date('zY') != date('zY', $time)) { echo date('F jS, Y', $time); } else { echo date('g:i a', $time); } ?></em>
								<p class="read">Dear Sir:</p>
<?php
				foreach($lines as $line) {
					$line = trim($line);
					if($line) {
?>
								<p><?php echo $line; ?></p>
<?php
					}
				}
?>
								<p class="read">Sincerely,</p>
								<cite><?php echo $name; ?></cite>
							</li>
						</ul>
					</li>
<?php
			}
		} else {
?>
					<li class="block leader contained">
						<p><a href="page.php?number=<?php echo $article_number; ?>">Write a Letter to the Editor.</a></p>
					</li>
<?php
		}
?>
				</ul>
			</li>
<?php
	}
	include('inc/foot.php');
?>