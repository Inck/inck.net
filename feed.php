<?php
	header("Content-Type: application/rss+xml");
	$directory = opendir('pages');
	error_reporting(0);
?>
<rss version="2.0">
	<channel>
		<title>Inck</title>
		<link>http://inck.net/</link>
		<description>Mid-to-Late Afternoon Edition</description>
		<language>en-us</language>
		<copyright>Copyright 2010 Nicholas Hall</copyright>
<?php
	while($filename = readdir($directory)) {
		if($filename[0] != ".") {
			$lines = file('pages/' . $filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			
			// Array of articles with date as key, to sort before printing.
			$articles[substr($filename, 0, -4)] = $lines;
		}
	}
	function article_date_sort($a, $b) { return strtotime($a[1]) - strtotime($b[1]); }
	uasort($articles, 'article_date_sort');
	$articles = array_reverse($articles, true);
?>
		<lastBuildDate><?php $first = reset($articles); echo date(DATE_RSS, strtotime($first[1])); ?></lastBuildDate>
<?php
	$i = 0;
	foreach($articles as $page => $article) {
?>
		<item>
			<title><?php echo $article[0]; ?></title>
			<link>http://inck.net/<?php if($i) echo "page.php?number=" . $page; // Link top story to a1. ?></link>
			<guid isPermaLink="true">http://inck.net/page.php?number=<?php echo $page ?></guid>
			<description><?php echo $article[2]; ?></description>
			<pubDate><?php echo date(DATE_RSS, strtotime($article[1])); ?></pubDate>
		</item>
<?php
		$i++;
	}
?>
	</channel>
</rss>