<?php
	error_reporting(0);
	$words = array("no", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty", "thirty-one", "thirty-two", "thirty-three", "thirty-four", "thirty-five");
	$title = "Words on The Internet by Nicholas Hall";
	include 'inc/head.php';
	
	// Get a1 data.
	$a1 = explode("\n", file_get_contents("pages/a1"));
	$banner = $a1[0];
	$cut = $a1[1];
?>
			<li class="column twelve_units contained">
				<ul>
					<li class="column one_unit contained">
						<ul>
							<li class="module ear">
								<div>
									<strong><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8HQL3CPDL6R34">5<sup>⁵</sup><span id="letter_¢">¢</span></a></strong>
								</div>
							</li>
						</ul>
					</li>
					<li class="column ten_units">
						<ul>
							<li class="module flag">
								<h3>The <span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span> Some-Times</h3>
							</li>
						</ul>
					</li>
					<li class="column one_unit">
						<ul>
							<li class="module ear">
								<div>
									<h2>The Weather</h2>
									<p>Feels like 98.6°F.</p>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="module edition">
						<cite>Volume 11, <a href='https://github.com/Inck/inck.net/issues/' id='issue_link'>Issue 1</a>, <a href='https://github.com/Inck/inck.net/' id='commit_link'>Commit </a> ~ <em><?php echo $edition; ?></em> ~ Today was September 30th, 2012<?php //echo date('l, F jS'); ?></cite>
					</li>
					<li class="module rule"></li>
				</ul>
			</li>
			<li class="column nine_units contained">
				<ul>
<?php
	$article = explode(' ', $a1[2]);
	$page = $article[0];
	$jump = $article[1];
	if($banner) {
?>
					<li class="module banner">
						<h1><a href="page.php?number=<?php echo $page; ?>" id="<?php echo $page; ?>"><?php echo $banner; ?></a></h1>
					</li>
<?php
	}
?>
					<li class="column three_units contained">
						<ul>
							<li data-article="1" data-column="1" class="module leader first front hyphenate">
<?php
	$indent =
"								";
	include 'inc/article.php';
?>
							</li>
						</ul>
					</li>
					<li class="column six_units">
						<ul>
							<li class="module cut">
								<?php echo $cut; ?>
							</li>
							<li class="column three_units contained">
								<ul>
									<li data-article="1" data-column="2" class="module leader hyphenate"></li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li data-article="1" data-column="3" class="module leader hyphenate"></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="column nine_units contained">
						<ul>
							<li class="module sidebar">
								<h3><?php echo $a1[6]?></h3>
								<table>
<?php
	$data = array_slice($a1, 7);
	$column_index = 1;
	foreach($data as $row) {
		$columns = explode(',', $row);
?>
									<tr>
<?php
		$row_index = 1;
		foreach($columns as $column) {
			if($row_index == 1 or $column_index == 1) {
?>
										<th><?php echo $column; ?></th>
<?php
			} else {
?>
										<td><?php echo $column; ?></td>
<?php
			}
			$row_index++;
		}
		$column_index++;
?>
									</tr>
<?php
	}
?>
								</table>
							</li>
							<li class="column three_units contained">
								<ul>
									<li data-article="2" data-column="1" class="module leader hyphenate">
<?php
	$indent =
"										";
	$article = explode(' ', $a1[4]);
	$page = $article[0];
	$jump = $article[1];
	include 'inc/article.php';
?>
									</li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<!-- <li class="space leader hyphenate"></li> -->
									<li data-article="2" data-column="2" class="module leader hyphenate"></li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li data-article="3" data-column="1" class="module leader hyphenate">
<?php
	$indent =
"										";
	$article = explode(' ', $a1[5]);
	$page = $article[0];
	$jump = $article[1];
	include 'inc/article.php';
?>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="column three_units">
				<ul>
					<li data-article="4" data-column="1" class="module leader hyphenate">
<?php
	$indent =
"						";
	$article = explode(' ', $a1[3]);
	$page = $article[0];
	$jump = $article[1];
	include 'inc/article.php';
?>
					</li>
				</ul>
			</li>
			<script>
				$.ajax({
					url:'https://api.github.com/repos/Inck/inck.net/commits',
					dataType: 'json',
					success:function(data){
						var commit = data[0].sha;
						$('#commit_link').text('Commit '+commit.substring(0, 6)).attr('href', 'https://github.com/Inck/inck.net/commit/'+commit);
					}
				});

				$.ajax({
					url:'https://api.github.com/repos/Inck/inck.net/issues?state=open&direction=asc',
					dataType: 'json',
					success:function(data){
						var issue = data.shift().number
						$('#issue_link').text('Issue '+issue).attr('href', 'https://github.com/Inck/inck.net/issues/'+issue);
					}
				});
			</script>
<?php
	include 'inc/foot.php';
?>
