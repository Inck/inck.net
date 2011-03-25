<?php
	$title = "Letters to the Editor";
	include('inc/head.php');
?>
			<li class="column one_unit contained">
				<ul>
					<li class="block flag secondary">
						<h3><a href="./"><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></a></h3>
					</li>
				</ul>
			</li>
			<li class="space nine_units"></li>
			<li class="column two_units rule_at_left">
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
	$directory = opendir('letters');
	while($filename = readdir($directory)) {
		if($filename[0] != ".") {
			$filenames[] = $filename;
		}
	}
	
	$filenames = array_reverse(array_slice($filenames, -3));
	
	foreach($filenames as $filename) {
?>
			<li class="column three_units contained">
				<ul>
<?php
		$article = file_get_contents('pages/' . $filename); $lines = explode("\n", $article);
		$article_title = trim($lines[0]);
		$article_date = trim($lines[1]);
		$article_number = substr($filename, 0, -4);
		$prompt_paragraph = "Having read '$article_title', I have the following comment.";
		$letters_together = file_get_contents('letters/' . $filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
?>
					<li class="block leader contained">
						<h2><a href="page.php?number=<?php echo $article_number; ?>"><?php echo $article_title; ?></a></h2>
						<cite>by Nicholas Hall on <em><?php echo $article_date; ?></em></cite>
					</li>
<?php
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
								<cite><a href="" rel="nofollow"><?php echo $name; ?></a></cite>
							</li>
						</ul>
					</li>
<?php
		}
?>
				</ul>
			</li>
			<li class="space one_unit"></li>
<?php
	}
	include('inc/foot.php');
?>