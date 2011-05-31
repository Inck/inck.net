<?php
	$title = "Late-to-Mid Morning Edition";
	include 'inc/head.php';
	
	// Get article list from feed.
	$feed = `php feed.php`;
	$articles = new SimpleXMLElement($feed);
	$article = substr($articles->channel->item[0]->guid, 32);
?>
			<li class="column twelve_units contained">
				<ul>
					<li class="column three_units contained">
						<ul>
							<li class="block ear">
								<div>
									<strong><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8HQL3CPDL6R34">99¢</a></strong>
								</div>
							</li>
						</ul>
					</li>
					<li class="column six_units">
						<ul>
							<li class="block flag">
								<h3><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></h3>
							</li>
						</ul>
					</li>
					<li class="column three_units">
						<ul>
							<li class="block dog_ear right">
								<h3><a href="letters.php"><em>Newish!</em> Letters to the Editor</a></h3>
								<div class="page_corner"><div class="page_fold"></div></div>
							</li>
							<li class="block ear">
								<div>
									<h2>The Weather</h2>
									<p>Occasional Rain, Warming. Distant Winds Out of the West.</p>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="column twelve_units contained">
				<ul>
					<li class="block edition">
						<cite><?php echo $edition; ?> -- <?php echo $title; ?> -- Updated: <em>Mid Day</em></cite>
					</li>
					<li class="block rule"></li>
				</ul>
			</li>
			<li class="column nine_units contained">
				<ul>
<?php
	$a1 = explode("\n", file_get_contents("pages/a1"));
	$cut = $a1[1];
	$banner = $a1[0];
	if($banner) {
?>
					<li class="block banner">
						<h1><a href="page.php?number=<?php echo $article; ?>" id="<?php echo $article; ?>"><?php echo $banner; ?></a></h1>
					</li>
<?php
	}
?>
					<li class="column three_units contained">
						<ul>
							<li data-article="1" data-column="1" class="block leader first front hyphenate">
<?php
	$indent =
"								";
	$jump = $a1[2];
	$article = substr($articles->channel->item[0]->guid, 32);
	include 'inc/article.php';
?>
							</li>
						</ul>
					</li>
					<li class="column six_units">
						<ul>
							<li class="block cut">
								<?php echo $cut; ?>
							</li>
							<li class="column three_units contained">
								<ul>
									<li data-article="1" data-column="2" class="block leader hyphenate"></li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li data-article="1" data-column="3" class="block leader hyphenate"></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="column nine_units contained">
						<ul>
							<li class="block sidebar">
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
									<li data-article="2" data-column="1" class="block leader hyphenate">
<?php
	$indent =
"										";
	$jump = $a1[4];
	$article = substr($articles->channel->item[2]->guid, 32);
	include 'inc/article.php';
?>
									</li>
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li class="block leader hyphenate"></li>
									<!-- <li data-article="2" data-column="2" class="block leader hyphenate"></li> -->
								</ul>
							</li>
							<li class="column three_units">
								<ul>
									<li data-article="3" data-column="1" class="block leader hyphenate">
<?php
	$indent =
"										";
	$jump = $a1[5];
	$article = substr($articles->channel->item[3]->guid, 32);
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
					<li data-article="4" data-column="1" class="block leader hyphenate">
<?php
	$indent =
"						";
	$jump = $a1[3];
	$article = substr($articles->channel->item[1]->guid, 32);
	include 'inc/article.php';
?>
					</li>
				</ul>
			</li>
<?php
	include 'inc/foot.php';
?>