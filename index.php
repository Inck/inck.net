<?php
	$title = "Early Evening-In Edition";
	include 'inc/head.php';
	
	// Get a1 data.
	$a1 = explode("\n", file_get_contents("pages/a1"));
	$banner = $a1[0];
	$cut = $a1[1];
?>
			<li class="column twelve_units contained">
				<!-- <ul class="new" style="display:none;">
					<li>Hyphen-ation</li>
					<li></li>
					<li></li>
				</ul> -->
				<img src="img/instruction_to_jump.png" alt="click through to read easier" class="instruction" style="display:none; position:absolute; top:60px; left:150px; z-index:99;" />
				<ul>
					<li class="column three_units contained">
						<ul>
							<li class="module ear">
								<div>
									<strong><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8HQL3CPDL6R34">99¢</a></strong>
								</div>
							</li>
						</ul>
					</li>
					<li class="column six_units">
						<ul>
							<li class="module flag">
								<h3><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></h3>
							</li>
						</ul>
					</li>
					<li class="column three_units">
						<ul>
							<li class="module dog_ear right">
								<section><a href="#/instruction"><em>Slightly Better!</em> Legibility after the Jump</a></section>
								<!-- <section><em>New Things!</em><input type="checkbox" id="new" name="new" /> <a href="#/new"><label for="new">Show</label></a></section> -->
								<div class="page_corner"><div class="page_fold"></div></div>
							</li>
							<li class="module ear">
								<div>
									<h2>The Weather</h2>
									<p>Raining and Cool. Twister Warnings Moving to the North.</p>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="module edition">
						<cite><!-- <a id="issue"> --><?php echo $edition; ?><!-- </a> --> -- <em><?php echo $title; ?></em> -- <a href="letters.php">Read Letters to the Editor</a></cite>
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
								<h3>Common English Metrical Feet</h3>
								<table>
									<tr>
										<th></th>
										<th>Iamb</th>
										<th>Trochee</th>
										<th>Spondee</th>
										<th>Dactyl</th>
									</tr>
									<tr>
										<th>Scansion</th>
										<td>˘ /</td>
										<td>/ ˘</td>
										<td>/ ˘ ˘</td>
										<td>˘ ˘ /</td>
									</tr>
									<tr>
										<th>Example</th>
										<td>destroy</td>
										<td>always</td>
										<td>everything</td>
										<td>entertains</td>
									</tr>
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
<?php
	include 'inc/foot.php';
?>