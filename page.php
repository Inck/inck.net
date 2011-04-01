<?php
	if($number = $_GET['number']) {
		$lines = file("pages/$number.txt", FILE_TEXT);
		$title = trim(array_shift($lines));
		$date = trim(array_shift($lines));
		$lede = explode(' -- ', $lines[1]);
		if($lede[1]) { // If there was a dateline.
			$dateline = trim($lede[0]);
			$lines[1] = $lede[1];
		}
		$text = implode('', $lines);
		$paragraphs = explode("\n\n", $text);
		$words_read = $_GET['from'];

		// Comment Submission
		$default_letter = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
		$default_name = "Mr. Your Name";
		
		if($_POST['letter_submitted'] == 'true') {
			if($_POST['is_computer'] == 'beep') { $user_message = "Sender Not Person"; }
			elseif(!$_POST['letter'] or $_POST['letter'] == $default_letter) { $user_message = "Words Not Written"; }
			elseif(!$_POST['name'] or $_POST['name'] == $default_name) { $user_message = "Name Not Given"; }
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
						<cite>Page <?php echo $number;  ?></cite>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="block rule"></li>
				</ul>
			</li>
			<li class="column three_units contained">
				<ul>
					<li id="main_article" data-article="1" data-column="1" class="block leader continued hyphenate">
						<h1><?php if($words_read) echo "Continued from '"; echo $title; if($words_read) echo "'"; ?></h1>
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
				echo $indent . "<p>"; if($dateline) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph . "</p>\n";
			}
		}
	}
?>
					</li>
				</ul>
			</li>
<?php
/* This is sort of pointless until/unless I implement a confirmation step.
	if($letter_published) {
		$letters_together = file_get_contents("letters/$number.txt");
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
		$letter = array_pop($letters);
		$lines = explode("\n\n", $letter);
		$time = array_shift($lines);
		$name = array_pop($lines);
?>
			<li class="column two_units">
				<ul>
					<li class="block leader letter_header read">
						<h2>Your Letter:</h2>
					</li>
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
	} else {
*/
?>
			<li class="column nine_units">
				<ul>
					<li class="space two_units contained"></li>
<?php
	// }
?>
					<li class="column seven_units">
						<form action="" method="post">
						<ul>
							<li class="column four_units contained">
								<ul>
									<li class="block leader letter postcard read">
										<h2>Dear Sir:</h2>
										<textarea id="letter" name="letter" <?php if(!$_POST or $_POST['letter'] == $default_letter) { echo 'class="read"'; } ?> onfocus="if(this.value=='<?php echo $default_letter; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_letter; ?>'; this.className='read' }" tabindex="1" rows="10" cols="100"><?php if($_POST['letter']) { echo stripslashes($_POST['letter']); } else { echo $default_letter; } ?></textarea>
										<label for="name">Sincerely,</label>
										<input type="text" id="name" name="name" <?php if(!$_POST or $_POST['name'] == $default_name) { echo 'class="read"'; } ?> value="<?php if($_POST['name']) { echo stripslashes($_POST['name'])	; } else { echo $default_name; } ?>" onfocus="if(this.value=='<?php echo $default_name; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_name; ?>'; this.className='read' }" tabindex="2" />
									</li>
								</ul>
							</li>
							<li class="column three_units">
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
										<address>Write in the space to the left, and sign</address>
										<address>below it. Apply postage to send.</address>
										<address>Are you a computer? <label><input type="radio" name="is_computer" value="no"<?php if($_POST['is_computer'] == "no") { ?> checked="checked"<?php } ?> /> No.</label> <label><input type="radio" name="is_computer" value="beep"<?php if($_POST['is_computer'] != "no") { ?> checked="checked"<?php } ?>  /> Beep.</label></address>
										<input type="hidden" id="letter_submitted" name="letter_submitted" value="true" />
									</li>
									<li class="block postcard_corner">
										<div></div>
									</li>
								</ul>
							</li>
						</ul>
						</form>
					</li>
<?php
	if(is_file("letters/$number.txt")) {
		$showing_letter_section = true;
		$letters_together = file_get_contents("letters/$number.txt");
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
		$letters = array_reverse($letters);
?>
					<li class="space two_units contained"></li>
					<li class="column two_units">
						<a name="letters"></a>
						<ul>
<?php
		foreach(array_slice($letters, 0, ceil(count($letters)/2)) as $letter) {
			$lines = explode("\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
?>
							<li class="block letter_box">
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
?>
						</ul>
					</li>
					<li class="space two_units contained"></li>
<?php
		if((count($letters) - 1) and array_slice($letters, count($letters)/2)) {
?>
					<li class="column two_units">
						<ul>
<?php
			foreach(array_slice($letters, count($letters)/2) as $letter) {
				$lines = explode("\n", $letter);
				$time = array_shift($lines);
				$name = array_pop($lines);
?>
							<li class="block letter_box">
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
?>
						</ul>
					</li>
<?php
		} else {
?>
					<li class="space two_units"></li>
<?php
		}
?>
				</ul>
			</li>
<?php
	}
	include('inc/foot.php');
?>