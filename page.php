<?php
	// From comment by n-jones at fredesign dot net on http://php.net/manual/en/function.system.php.
	function mysystem($command) {
		if (!($p=popen("($command)2>&1","r"))) { 
			return 126;
		}

		while (!feof($p)) {
			$line=fgets($p,1000);
			$out .= $line;
		}
		pclose($p);
		return $out; 
	}

	// header('HTTP/1.1 301 Moved Permanently');
	// header('Location: http://inck.net/letters/');
	if($number = $_GET['number']) {
		$lines = file("pages/$number.txt", FILE_TEXT);
		$title = trim(array_shift($lines));
		$date = trim(array_shift($lines));
		$lede = explode(' -- ', $lines[1]);
		if(isset($lede[1]) and $lede[1]) { // If there was a dateline.
			$dateline = trim($lede[0]);
			$lines[1] = $lede[1];
		}
		$text = implode('', $lines);
		$paragraphs = explode("\n\n", $text);
		if(isset($_GET['from'])) $words_read_left = $_GET['from'];

		// Comment Submission
		$default_letter = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
		$default_name = "Marcus Tullius Cicero";
/*		
		if(isset($_POST['letter_submitted']) and $_POST['letter_submitted'] == 'true') {
			if($_POST['is_computer'] == 'beep') { $user_message = "Sender Not Person"; }
			elseif(!$_POST['letter'] or $_POST['letter'] == $default_letter) { $user_message = "Words Not Written"; }
			elseif(!$_POST['name'] or $_POST['name'] == $default_name) { $user_message = "Name Not Given"; }
			elseif(strpos(file_get_contents("letters/$number.txt"), $_POST['name']) and strpos(file_get_contents("letters/$number.txt"), $_POST['letter'])) { $user_message = "Duplicate Letter Found"; }
			else {
				$letters_file = "letters/$number.txt";
				file_put_contents($letters_file, time() . "\n\n" . $_POST['letter'] . "\n\n" . $_POST['name'] . "\n\n-----------------\n\n", FILE_APPEND);
				unset($_POST);
				
				// Commit letter to Git.
				$path = getenv('PATH');
				putenv("PATH=/usr/local/git/libexec/git-core:$path");
				`sudo -u ec2-user git add $letters_file`;
				`sudo -u ec2-user git commit -m 'Someone added a new comment.'`;
				$letter_published = true;
			}
		}*/
	} else {
		$number = "that does not exist.";
		exit;
	}
	
	include('inc/head.php');
?>
			<li class="column ten_units contained">
				<ul>
					<li class="module flag secondary">
						<h3><a href="./">The <span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span> Some-Times</a></h3>
					</li>
				</ul>
			</li>
			<li class="column two_units">
				<ul>
					<li class="module edition secondary">
						<cite><?php echo $edition; ?></cite>
						<cite>Page <?php echo chr(97 + mt_rand(0, 25)).rand(0,99);  ?></cite>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="module rule"></li>
				</ul>
			</li>
			<li class="column five_units contained rule_at_right">
				<ul>
					<li id="main_article" class="module leader legible continued">
						<h1><?php echo $title; if(isset($words_read_left) and $words_read_left) echo "<span class='read'> Continued</span>"; ?></h1>
						<cite>by <a href="http://twitter.com/#!/inck">Nicholas Hall</a> on <em><?php echo $date; ?></em></cite>
<?php
	$indent =
"						";
	foreach($paragraphs as $paragraph) {
		$paragraph = trim($paragraph);
		if(isset($words_read_left) and $words_read_left > 0) {
			$words = explode(' ', $paragraph);
			$words_printing = count($words);
			if($words_printing <= $words_read_left) {
				echo $indent . "<p class='read'>"; if(isset($dateline)) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph . "</p>\n";
			} elseif($words_read_left > 0) {
				echo $indent . "<p><a name='$number'></a><span class='read'>" . implode(' ', array_slice($words, 0, $words_read_left)) . "</span> " . implode(' ', array_slice($words, $words_read_left)) . "</p>\n";
			} else {
				echo $indent . "<p>" . $paragraph . "</p>\n";
			}
			$words_read_left -= $words_printing;
		} else {
			// If there are linebreaks and no HTML.
			if(preg_match("|\n|", $paragraph) and !preg_match("|</|", $paragraph)) {
				$lines = explode("\n", $paragraph);
				echo $indent . "<p>" . array_shift($lines);
				foreach($lines as $line) {
					echo "<br />\n";
					echo $indent . $line;
				}
 				echo "</p>\n";
			} else {
				echo $indent . "<p>"; if(isset($dateline) and $dateline) { ?><span class="dateline"><?php echo $dateline; ?></span><?php unset($dateline); } echo $paragraph . "</p>\n";
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
					<li class="module letter_header prompt">
						<h2>Your Letter:</h2>
					</li>
					<li class="module letter">
						<em><?php if(date('zY') != date('zY', $time)) { echo date('F jS, Y', $time); } else { echo date('g:i a', $time); } ?></em>
						<p class="prompt">Dear Sir:</p>
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
						<p class="prompt">Sincerely,</p>
						<cite><a href="" rel="nofollow"><?php echo $name; ?></a></cite>
					</li>
				</ul>
			</li>
<?php
	} else {
*/
?>
			<li class="column seven_units">
				<ul>
<?php
	// }
?>
					<li class="column seven_units contained">
						<form action="#letters" method="post">
						<ul>
							<li class="column four_units contained">
								<ul>
									<li class="module letter postcard prompt">
										<h2>Dear Sir:</h2>
										<textarea id="letter" name="letter" <?php if(!$_POST or $_POST['letter'] == $default_letter) { echo 'class="prompt"'; } ?> onfocus="if(this.value=='<?php echo $default_letter; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_letter; ?>'; this.className='prompt' }" tabindex="1" rows="10" cols="100"><?php if(isset($_POST['letter']) and $_POST['letter']) { echo stripslashes($_POST['letter']); } else { echo $default_letter; } ?></textarea>
										<label for="name">Sincerely,</label>
										<input type="text" id="name" name="name" <?php if(!$_POST or $_POST['name'] == $default_name) { echo 'class="prompt"'; } ?> value="<?php if(isset($_POST['name']) and $_POST['name']) { echo stripslashes($_POST['name'])	; } else { echo $default_name; } ?>" onfocus="if(this.value=='<?php echo $default_name; ?>') { this.value=''; this.className='' }" onblur="if(this.value=='') { this.value='<?php echo $default_name; ?>'; this.className='prompt' }" tabindex="2" />
									</li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li class="module postcard_post">
<?php
	if(isset($user_message) and $user_message) {
?>
										<p>Letter Undelivered<br /> <?php echo $user_message; ?> <span>||| | | || | ||| ||</span></p>
<?php
	}
?>
										<p>Letters Undelivered<br /> Delivery Service Disabled Due to Robots <span>||| | | || | ||| ||</span></p>
										<label>
											<input type="button" value="<?php echo "Apply\nPostage"; ?>" onmousedown="this.className='hover';this.value='I';" tabindex="3" />
										</label>
									</li>
									<li class="module postcard_address">
										<address>Write in the space to the left, and sign</address>
										<address>below it. Apply postage to send.</address>
										<address>Are you a person? <label><input type="radio" name="is_computer" value="no"<?php if($_POST['is_computer'] == "no") { ?> checked="checked"<?php } ?> /> Yes.</label> <label><input type="radio" name="is_computer" value="beep"<?php if($_POST['is_computer'] != "no") { ?> checked="checked"<?php } ?>  /> Beep.</label></address>
										<input type="hidden" id="letter_submitted" name="letter_submitted" value="true" />
									</li>
									<li class="module postcard_corner">
										<div></div>
									</li>
								</ul>
							</li>
						</ul>
						</form>
					</li>
				</ul>
			</li>
<?php
	if(is_file("letters/$number.txt")) {
		$showing_letter_section = true;
		$letters_together = file_get_contents("letters/$number.txt");
		$letters = explode("\n\n-----------------\n\n", $letters_together); array_pop($letters);
		$letters = array_reverse($letters);
		$letter_responses = array();
?>
			<li class="column seven_units">
				<ul>
					<li class="column three_units contained">
						<a name="letters"></a>
						<ul>
<?php
		foreach($letters as $letter) {
			$response = explode("\n\n---------\n\n", $letter);
			$letter = $response[0];
			if(isset($response[1])) $letter_responses[] = $response[1];
			$lines = explode("\n", $letter);
			$time = array_shift($lines);
			$name = array_pop($lines);
?>
							<li class="module letter_box">
								<ul>
									<li class="module letter">
										<em><?php if(date('zY') != date('zY', $time)) { echo date('F jS, Y', $time); } else { echo date('g:i a', $time); } ?></em>
										<p class="prompt">Dear Sir:</p>
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
										<p class="prompt">Sincerely,</p>
										<cite><?php echo $name; ?></cite>
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
		if((count($letters)) and array_slice($letters, count($letters) / 2)) {
?>
					<li class="column three_units">
						<ul>
<?php
			foreach($letter_responses as $letter) {
				if($letter) {
					$lines = explode("\n", $letter);
					$time = strtotime(array_shift($lines));
					$name = array_pop($lines);
?>
							<li class="module letter_box">
								<ul>
									<li class="module letter">
										<em><?php if(date('zY') != date('zY', $time)) { echo date('F jS, Y', $time); } else { echo date('g:i a', $time); } ?></em>
										<p class="prompt">Dear Sir:</p>
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
										<p class="prompt">Sincerely,</p>
										<cite><?php echo $name; ?></cite>
									</li>
								</ul>
							</li>
<?php
				}
			}
?>
						</ul>
					</li>
<?php
		} else {
?>
					<!-- <li class="space two_units"></li> -->
<?php
		}
?>
				</ul>
			</li>
<?php
	}
	include('inc/foot.php');
?>