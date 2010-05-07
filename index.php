<?php
	$title = "Mid-to-Late Afternoon Edition";
	include('inc/head.php');
	
	// Get article list from feed script.
	ob_start();
		$internal = true;
	    include('feed.php');
	    $feed = ob_get_contents();
    ob_end_clean();
	$articles = new SimpleXMLElement($feed);
?>
			<li class="well twelve_columns contained">
				<ul>
					<li class="well three_columns contained">
						<ul>
							<li class="block syndicate_ear">
								<a href="http://feeds.feedburner.com/inck/" title="RSS"><img src="img/feed.png" alt="RSS Chicklet" /></a>
							</li>
							<li class="block ear">
								<div>
									<strong>25&cent;</strong>
									<p>(Mail to 669 Manhattan Avenue, Apartmnet 2, Brooklyn)</p>
								</div>
							</li>
						</ul>
					</li>
					<li class="well six_columns">
						<ul>
							<li class="block flag">
								<h3><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></h3>
								<cite>Volume One, Issue Three -- Mid-to-Late Afternoon Edition -- Updated: <em>Early Morning</em></cite>
								<!-- <cite>Volume One, Issue <form><input type="text" id="issue" name="issue" value="Three" size="4" /></form> &mdash; Mid-to-Late Afternoon Edition &mdash; Updated: <em>Early Morning</em></cite> -->
							</li>
						</ul>
					</li>
					<li class="well three_columns">
						<ul>
							<li class="block dog_ear">
								<h3><a href="page.php?number=c7">Letters to the Editor</a></h3>
								<div class="page_corner"><div class="page_fold"></div></div>
							</li>
							<li class="block ear">
								<div>
									<h2>The Weather</h2>
									<p>Warm, Bright and Overcast. Slow Winds Out of the Southeast.</p>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="well twelve_columns contained">
				<ul>
					<li class="block rule"></li>
				</ul>
			</li>
			<li class="well nine_columns contained">
				<ul>
<?php
	$a1 = explode("\n", file_get_contents("pages/a1"));
	$cut = $a1[1];
	$banner = $a1[0];
	$article = substr($articles->channel->item[0]->guid, 32);
?>
					<li class="block banner">
						<h1><a href="page.php?number=<?php echo $article; ?>" name="<?php echo $article; ?>"><?php echo $banner; ?></a></h1>
					</li>
					<li class="well three_columns contained">
						<ul>
							<li id="article1_column1_extra20" class="block leader first hyphenate">
<?php
	$indent = 8;
	$jump = $a1[2];
	$article = substr($articles->channel->item[0]->guid, 32);
	include('inc/article.php');
?>
							</li>
						</ul>
					</li>
					<li class="well six_columns">
						<ul>
							<li class="block cut">
								<?php echo $cut; ?>
							</li>
							<li class="well three_columns contained">
								<ul>
									<li id="article1_column2" class="block leader hyphenate"></li>
								</ul>
							</li>
							<li class="well three_columns">
								<ul>
									<li id="article1_column3" class="block leader hyphenate"></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="well nine_columns contained">
						<ul>
							<li class="block sidebar">
								<h3>The Conjugation of the Preterite Form</h3>
								<table>
									<tr>
										<th></th>
										<th>Yo</th>
										<th>Tú</th>
										<th>El, Ella o Usted</th>
										<th>Nosotros</th>
										<th>Ellos o Ustedes</th>
									</tr>
									<tr>
										<th>-ar</th>
										<td>-é</td>
										<td>-aste</td>
										<td>-ó</td>
										<td>-amos</td>
										<td>-aron</td>
									</tr>
									<tr>
										<th>-er</th>
										<td>-í</td>
										<td>-iste</td>
										<td>-ió</td>
										<td>-imos</td>
										<td>-ieron</td>
									</tr>
									<tr>
										<th>-ir</th>
										<td>-í</td>
										<td>-iste</td>
										<td>-ió</td>
										<td>-imos</td>
										<td>-ieron</td>
									</tr>
								</table>
							</li>
							<li class="well three_columns contained">
								<ul>
									<li id="article3_column1" class="block leader hyphenate">
<?php
	$indent = 10;
	$jump = $a1[4];
	$article = substr($articles->channel->item[2]->guid, 32);
	include('inc/article.php');
?>
									</li>
								</ul>
							</li>
							<li class="well three_columns">
								<ul>
									<li id="article3_column2" class="block leader hyphenate"></li>
								</ul>
							</li>
							<li class="well three_columns">
								<ul>
									<li id="article4_column1" class="block leader hyphenate">
<?php
	$indent = 10;
	$jump = $a1[5];
	$article = substr($articles->channel->item[3]->guid, 32);
	include('inc/article.php');
?>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="well three_columns">
				<ul>
					<li id="article2_column1" class="block leader hyphenate">
<?php
	$indent = 6;
	$jump = $a1[3];
	$article = substr($articles->channel->item[1]->guid, 32);
	include('inc/article.php');
?>
					</li>
				</ul>
			</li>
<?php
	include('inc/foot.php');
?>