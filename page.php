<?php
	if($number = $_GET['number']) {
		$lines = file("pages/$number.txt", FILE_TEXT);
		$title = trim(array_shift($lines));
		$date = trim(array_shift($lines));
		$lede = explode(' -- ', $lines[0]);
		if($lede[1]) { // If there was a dateline.
			$dateline = trim($lede[0]);
			$lines[0] = $lede[1];
		}
		$text = implode('', $lines);
		$paragraphs = explode("\n\n", $text);
		$words_read = $_GET['from'];

		// Comment Submission
		$prompt_paragraph = "Having read '$title', I have the following comment.";
		$default_letter = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
		$default_name = "Mr. Your Name";
		
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
			<li class="well three_columns rule_at_right contained">
				<ul>
					<li id="main_article" class="block leader continued hyphenate">
						<h1><a href="./"><?php if($words_read) echo "Continued from "; echo "'" . $title . "'"; ?></a></h1>
						<cite>by Nicholas Hall on <em><?php echo $date; ?></em></cite>
<?php
	$indent =
"						";
	foreach($paragraphs as $paragraph) {
		$paragraph = trim($paragraph);
		if($words_read > 0) {
			$words_read -= $words_printing;
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			if($words_printing <= $words_read) {
				echo $indent . "<p class='read'>"; if($dateline) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph . "</p>\n";
			} elseif($words_read > 0) {
				echo $indent . "<p><a name='$number'></a><span class='read'>" . implode(' ', array_slice($words, 0, $words_read)) . "</span> " . implode(' ', array_slice($words, $words_read)) . "</p>\n";
			} else {
				echo $indent . "<p>" . $paragraph . "</p>\n";
			}
		} else {
			// If there are linebreaks.
			if(preg_match("|\n|", $paragraph)) {
				$lines = explode("\n", $paragraph);
				echo $indent . "<p>" . array_shift($lines);
				foreach($lines as $line) {
					echo "<br />\n";
					echo $indent . $line;
				}
 				echo "</p>\n";
			} else {
				echo $indent . "<p>" . $paragraph . "</p>\n";
			}
		}
	}
?>
					</li>
				</ul>
			</li>
			<li class="well nine_columns rule_at_left">
				<form action="" method="post">
				<ul>
					<li class="well three_columns contained">
						<ul>
							<li class="block leader letter postcard read">
								<h2>Dear Sir:</h2>
								<p><?php echo $prompt_paragraph; ?></p>
								<textarea id="letter" name="letter" <?php if(!$_POST or $_POST['letter'] == $default_letter) { echo 'class="read"'; } ?> onfocus="if(this.value=='<?php echo $default_letter; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_letter; ?>'; this.className='read' }" tabindex="1" rows="10" cols="100"><?php if($_POST['letter']) { echo stripslashes($_POST['letter']); } else { echo $default_letter; } ?></textarea>
								-- <input type="text" id="name" name="name" <?php if(!$_POST or $_POST['name'] == $default_name) { echo 'class="read"'; } ?> value="<?php if($_POST['name']) { echo stripslashes($_POST['name'])	; } else { echo $default_name; } ?>" onfocus="if(this.value=='<?php echo $default_name; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_name; ?>'; this.className='read' }" tabindex="2" />
							</li>
						</ul>
					</li>
					<li class="well three_columns">
						<ul>
							<li class="block postcard_post">
<?php
	if($user_message) {
?>
								<p>Letter Undelivered<br /> <?php echo $user_message; ?> <span>||| | | || | ||| ||</span></p>
<?php
	}
?>
								<label>
									<input type="submit" value="<?php echo "Apply\nPostage"; ?>" onmousedown="this.className='hover';this.value='I';" tabindex="3" />
								</label>
							</li>
							<li class="block postcard_address">
								<address>You may type in the space to the left.</address>
								<address>Please use proper capitalization.</address>
								<address>Are you a computer? <label><input type="radio" name="is_computer" value="no"<?php if($_POST['is_computer'] == "no") { ?> checked="checked"<?php } ?> /> No.</label> <label><input type="radio" name="is_computer" value="beep"<?php if($_POST['is_computer'] != "no") { ?> checked="checked"<?php } ?>  /> Beep.</label></address>
								<input type="hidden" id="letter_submitted" name="letter_submitted" value="true" />
							</li>
							<li class="block postcard_corner">
								<div></div>
							</li>
						</ul>
					</li>
<?php
	if($letter_published) {
?>
					<li class="well three_columns">
						<ul>
							<li class="block leader letter_header read">
								<h2>Your Letter:</h2>
							</li>
							<li class="block leader letter">
								<p><?php echo $prompt_paragraph; ?></p>
<?php
			$letters_together = file_get_contents("letters/$number.txt");
			$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
			$letter = array_pop($letters);
			$lines = explode("\n\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
			foreach($lines as $line) { echo "<p>$line</p>"; }
?>
								<cite><?php echo $name . " at <em>" . date('g:i a', $time); ?></em></cite>
							</li>
						</ul>
					</li>
<?php
	}
?>
				</ul>
				</form>
			</li>
<?php
	if(is_file("letters/$number.txt")) {
		$showing_letter_section = true;
		$letters_together = file_get_contents("letters/$number.txt");
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);

		function letters_date_sort($a, $b) { return $a[1] - $b[1]; }
		uasort($letters, 'letters_date_sort');
?>
			<li class="well wrap nine_columns rule_at_left">
				<ul>
<?php
		foreach($letters as $letter) {
			$lines = explode("\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
?>
					<li class="block letter_box">
						<ul>
							<li class="block leader letter_header read">
								<h2>Dear Sir:</h2>
							</li>
							<li class="block leader letter">
								<p class="read"><?php echo $prompt_paragraph; ?></p>
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
								<cite><?php echo $name; if(date('zY') != date('zY', $time)) { echo " on <em>" . date('F jS, Y', $time); } else { echo " at <em>" . date('g:i a', $time); } ?></em></cite>
							</li>
						</ul>
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