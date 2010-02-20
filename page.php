<?php
	if($number = $_GET['number']) {
		$paragraphs = file("pages/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$title = array_shift($paragraphs);
		$date = array_shift($paragraphs);
		$lede = explode('.', $paragraphs[0]); $lede = $lede[0] . '.';
		$words_read = $_GET['from'];

		if($_GET['write']) {
			// Comment Submission
			$default_letter = "Based on my years of experience in a field that makes me an expert on the subject which Mr. Hall was attempting to discuss, I must say that...";
			$default_name = "Concerned Citizen";
		}
		
		if($_POST['letter_submitted'] == 'true') {
			if($_POST['is_computer'] == 'beep') { $user_message = "Sender Not a Person"; }
			elseif(!$_POST['letter'] or $_POST['letter'] == $default_letter) { $user_message = "No Words Written"; }
			elseif(!$_POST['name'] or $_POST['name'] == $default_name or $_POST['name'] == 'anonymous' or $_POST['name'] == 'Anonymous') { $user_message = "Name Not Given"; }
			elseif(strpos(file_get_contents("letters/$number.txt"), $_POST['name']) and strpos(file_get_contents("letters/$number.txt"), $_POST['letter'])) { $user_message = "Duplicate Letter Found"; }
			else {
				file_put_contents("letters/$number.txt", time() . "\n\n" . $_POST['letter'] . "\n\n" . $_POST['name'] . "\n\n-----------------\n\n", FILE_APPEND);
				unset($_POST);
				$letter_published = true;
			}
		}
	} else {
		$number = "that does not exist.";
		exit;
	}
	
	include('inc/head.php');
?>
			<li class="set three_columns separated_at_right contained">
				<ul>
					<li id="main_article" class="module leader continued hyphenate">
						<h1><a href="/"><?php if($words_read) echo "Continued from "; echo "'" . $title . "'"; ?></a></h1>
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
	
	$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/$number.txt"))) - 1;
	if($number_of_letters) {
?>
						<p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this article.) <a href="?number=<?php echo $number; ?>#top">Read them</a> and <a href="?number=<?php echo $number; ?>&write=true#top">write one</a>.</p>
<?php
	} else {
?>
						<p class="letters">(There are currently no Letters to the Editor in response to this article.) <a href="?number=<?php echo $number; ?>&write=true#top">Write one</a>.</p>
<?php
	}
?>
					</li>
				</ul>
			</li>
<?php
	if($_GET['write'] == "true") {
?>
			<li class="set nine_columns separated_at_left">
				<form action="" method="post">
					<input type="hidden" id="letter_submitted" name="letter_submitted" value="true" />
					<ul>
						<li class="set three_columns contained">
							<ul>
								<li class="module leader postcard read hyphenate">
									<h2>Dear Sir:</h2>
									<p>In his <?php echo $date; ?> article, "<?php echo $title; ?>," Nicholas Hall writes, "<?php echo $lede; ?>"</p>
									<textarea id="letter" name="letter" <?php if(!$_POST or $_POST['letter'] == $default_letter) { echo 'class="read"'; } ?> onfocus="if(this.value=='<?php echo $default_letter; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_letter; ?>'; this.className='read' }" tabindex="1"><?php if($_POST['letter']) { echo stripslashes($_POST['letter']); } else { echo $default_letter; } ?></textarea>
									-- <input type="text" id="name" name="name" <?php if(!$_POST or $_POST['name'] == $default_name) { echo 'class="read"'; } ?> value="<?php if($_POST['name']) { echo stripslashes($_POST['name'])	; } else { echo $default_name; } ?>" onfocus="if(this.value=='<?php echo $default_name; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_name; ?>'; this.className='read' }" tabindex="2" />
								</li>
							</ul>
						</li>
						<li class="set three_columns">
							<ul>
								<li class="module postcard_post">
<?php
		if($user_message) {
?>
									<p>Letter Undelivered<br /> <?php echo $user_message; ?> <span>||| | | || | ||| ||</span></p>
<?php
		}
?>
									<label>
										<input type="submit" value="Post" onmouseover="this.value='&nbsp;';this.className='hover'" onmouseout="this.value='Post';this.className=''" tabindex="3" />
									</label>
								</li>
								<li class="module postcard_address">
									<address>You may type in the space to the left.</address>
									<address>Please use proper capitalization.</address>
									<address>Are you a computer? <label><input type="radio" id="is_computer" name="is_computer" value="no"<?php if($_POST['is_computer'] == "no") { ?> checked="checked"<?php } ?> /> No.</label> <label><input type="radio" id="is_computer" name="is_computer" value="beep"<?php if($_POST['is_computer'] != "no") { ?> checked="checked"<?php } ?>  /> Beep.</label></address>
								</li>
							</ul>
						</li>
						<li class="set three_columns">
							<ul>
<?php
		if(is_file("letters/$number.txt") and !$letter_published) {
?>
								<li class="module leader letter_header">
									<p><a href="?number=<?php echo $number; ?>">Read the Letters to the Editor</a>.</p>
								</li>
<?php
		} elseif($letter_published) {
?>
								<li class="module leader letter_header read">
									<h2>Your Letter:</h2>
								</li>
								<li class="module leader">
									<p class="read">In his <?php echo $date; ?> article, "<?php echo $title; ?>," Nicholas Hall writes, "<?php echo $lede; ?>"</p>
<?php
			$letters_together = file_get_contents("letters/$number.txt");
			$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
			$letter = array_pop($letters);
			$lines = explode("\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
			foreach($lines as $line) { echo "\t\t\t\t\t\t\t\t\t\t\t\t<p>$line</p>"; }
?>
									<p>--<cite><?php echo $name . " at " . date('g:i a', $time); ?></cite></p>
								</li>
<?php
		}
?>
							</ul>
						</li>
					</ul>
				</form>
			</li>
<?php
		$showing_letter_section = true;
	} elseif(is_file("letters/$number.txt")) {
?>
			<li class="set nine_columns separated_at_left">
				<ul>
					<li class="module leader letter_header">
						<p><a href="?number=<?php echo $number; ?>&write=true">Write a Letter to the Editor</a>.</p>
						<h2>Dear Sir:</h2>
					</li>
<?php
		$letters_together = file_get_contents("letters/$number.txt");
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);

		function letters_date_sort($a, $b) { return $a[1] - $b[1]; }
		uasort($letters, 'letters_date_sort');
		$letters = array_reverse($letters, true);

		$i = 0;
		foreach($letters as $letter) {
			$lines = explode("\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
?>
					<li class="set three_columns<?php if(!$i or is_int($i/3)) echo ' contained'; ?> hyphenate">
						<ul>
							<li class="module leader">
								<p class="read">In his <?php echo $date; ?> article, "<?php echo $title; ?>," Nicholas Hall writes, "<?php echo $lede; ?>"</p>
<?php
			foreach($lines as $line) { echo "<p>$line</p>"; }
?>
								<p>--<cite><?php echo $name; if(date('zY') != date('zY', $time)) { echo " on " . date('F jS, Y', $time); } else { echo " at " . date('g:i a', $time); } ?></cite></p>
							</li>
						</ul>
					</li>
<?php
			$i++;
		}
?>
				</ul>
			</li>
<?php
		$showing_letter_section = true;
	}
?>
			<li class="set nine_columns separated_at_left continued">
				<ul>
<?php
	$old_articles = array('a2', 'p5'); // , 'j12'
	$i = 1;
	foreach($old_articles as $old_article) {
?>
					<li class="module leader read hyphenate flow<?php if($i == 1 and !$showing_letter_section) echo ' first'; ?>">
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
		$i++;
	}
?>
				</ul>
			</li>
<?php
	include('inc/foot.php');
?>