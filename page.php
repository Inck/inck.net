<?php
	if($number = $_GET['number']) {
		$paragraphs = file("pages/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$title = array_shift($paragraphs);
		$date = array_shift($paragraphs);
		$lede = explode(' -- ', $paragraphs[0]);
		$dateline = $lede[0]; $paragraphs[0] = $lede[1];
		$words_read = $_GET['from'];

		// Comment Submission
		$prompt_paragraph = "Having just read Mr. Hall's article, '$title', I must offer this most apropos observation.";
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
					<li id="main_article" class="module leader continued hyphenate">
						<h1><a href="./"><?php if($words_read) echo "Continued from "; echo "'" . $title . "'"; ?></a></h1>
						<cite>by Nicholas Hall on <em>February 12th, 2010</em></cite>
<?php
	foreach($paragraphs as $paragraph) {
		if($words_read > 0) {
			$words_read -= $words_printing;
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			if($words_printing <= $words_read) {
				echo "\t\t\t\t\t\t<p class='read'>"; if($dateline) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph . "</p>\n";
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
						<p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this article.) <a href="?number=<?php echo $number; ?>#top">Write one</a>.</p>
<?php
	} else {
?>
						<p class="letters">(There are currently no Letters to the Editor in response to this article.) <a href="?number=<?php echo $number; ?>#top">Write one</a>.</p>
<?php
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
			$letters_together = file_get_contents("letters/$number.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
			$letter = array_pop($letters);
			$lines = explode("\n\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
			foreach($lines as $line) { echo "\t\t\t\t\t\t\t\t\t\t\t\t<p>$line</p>"; }
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

		$i = 0;
		foreach($letters as $letter) {
			$lines = explode("\n\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
			
			if(!$i or is_int($i/3)) {
?>
			<li class="well nine_columns rule_at_left">
				<ul>
					<li class="well three_columns contained">
<?php
			} else {
?>
					<li class="well three_columns">
<?php
			}
?>
						<ul>
							<li class="block leader letter_header read">
								<h2>Dear Sir:</h2>
							</li>
							<li class="block leader letter">
								<p class="read"><?php echo $prompt_paragraph; ?></p>
<?php
			foreach($lines as $line) { echo "\t\t\t\t\t\t\t\t<p>$line</p>\n"; }
?>
								<cite><?php echo $name; if(date('zY') != date('zY', $time)) { echo " on <em>" . date('F jS, Y', $time); } else { echo " at <em>" . date('g:i a', $time); } ?></em></cite>
							</li>
						</ul>
					</li>
<?php
			if(is_int(($i+1)/3)) {
?>
				</ul>
			</li>
<?php
			}
			$i++;
		}
	}
/* // Filler articles.
?>
			<li class="well nine_columns rule_at_left continued">
				<ul>
<?php
	$old_articles = array('a2', 'p5'); // , 'j12'
	$i = 1;
	foreach($old_articles as $old_article) {
?>
					<li class="block leader read hyphenate flow<?php if($i == 1 and !$showing_letter_section) echo ' first'; ?>">
<?php
		$filler_paragraphs = file("pages/$old_article.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$filler_title = array_shift($filler_paragraphs);
		$filler_date = array_shift($filler_paragraphs);
?>
						<h2>'<?php echo $filler_title; ?>'</h2>
						<cite>by Nicholas Hall on <?php echo $filler_date; ?></cite>
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
*/
	include('inc/foot.php');
?>