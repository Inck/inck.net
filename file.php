<?php
	error_reporting(E_ALL);
	if($_POST['filed']) {
		if($_POST['password'] == '*ts01mdh') {
			if($_POST['replaced']) {
				// Get article list from feed script.
				ob_start();
					$internal = true;
				    include('feed.php');
				    $feed = ob_get_contents();
			    ob_end_clean();
				$articles = new SimpleXMLElement($feed);
				$page = substr($articles->channel->item[0]->guid, 32);
			} else {
				$alphabet = "abcdefghijklmnopqrstuvwxyz";
				while(file_exists("pages/$page")) { // Ensure the "page number" doesn't already exist.
					$page = $alphabet[rand(0, 25)] . rand(1, 17);
				}
			}
			$new_a1 = $_POST['banner'] . "\n" . $_POST['cut'] . "\n" . $_POST['first_article'] . "\n" . $_POST['second_article'] . "\n" . $_POST['third_article'] . "\n" . $_POST['fourth_article'];
			file_put_contents($new_a1);
	        echo move_uploaded_file($_FILES["pictures"]["name"][$key], "pages/$page.txt");
		} else {
			echo "You did not provide the correct password. Please try again, or fuck off.";
		}
	} else {
		$a1 = file('pages/a1');
		$_POST['first_article'] = $a1[2];
		$_POST['second_article'] = $a1[3];
		$_POST['third_article'] = $a1[4];
		$_POST['fourth_article'] = $a1[5];
	}

	if($_POST['paged']) {
		if($_POST['password'] == '*ts01mdh') {
			
		} else {
			echo "You did not provide the correct password. Please try again, or fuck off.";
		}
	} else {
		$a1 = file('pages/a1', FILE_IGNORE_NEW_LINES);
		$current_banner = $a1[0];
		$current_cut = htmlentities($a1[1]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Inck ~ File</title>
		<style type="text/css">
			body { font-family:'Helvetica'; font-size:11px; }
			input { margin:5px 0; }
			#filer label { display:block; }
			#banner { font-family:'Hoefler Text'; font-size:52px; }
			#banner, #cut { width:880px; }
			#password { width:86px; }
			#pager { margin-top:25px; width:150px; }
			#pager label { float:left; margin-right:5px; }
			#pager label input { display:block; width:25px; margin-right:25px; text-align:right; }
		</style>
		<script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
		<script type="text/javascript">
			$(function() {
				var current_banner = '<?php echo $current_banner; ?>';
				var current_cut = '<?php echo html_entity_decode($current_cut); ?>';
				$("#replaced").click(function(){
					if($("#replaced").attr("checked") == true) {
						$("#banner").attr({ value: current_banner });
						$("#cut").attr({ value: current_cut });
					} else {
						$("#banner").attr({ value: '' });
						$("#cut").attr({ value: '' });
					}
				});
			});
		</script>
	</head>
	<body>
		<form method="post" enctype="multipart/form-data" id="filer">
			<label for="file">
				<input type="file" id="file" name="file" />
			</label>
			<label for="banner">
				<input type="text" id="banner" name="banner" /> Banner
			</label>
			<label for="cut">
				<input type="text" id="cut" name="cut" /> Cut
			</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000" />
			<input type="password" id="password" name="password" /> <input type="submit" value="File" /> 
			<label for="replaced">
				<input type="checkbox" id="replaced" name="replaced" /> Update first article
			</label>
			<input type="hidden" id="filed" name="filed" value="true" />
		</form>
		<form method="post" id="pager">
			<label for="first_article">First
				<input type="text" id="first_article" name="first_article" value="<?php echo $_POST['first_article']; ?>" />
			</label>
			<label for="second_article">Second
				<input type="text" id="second_article" name="second_article" value="<?php echo $_POST['second_article']; ?>" />
			</label>
			<label for="third_article">Third
				<input type="text" id="third_article" name="third_article" value="<?php echo $_POST['third_article']; ?>" />
			</label>
			<label for="fourth_article">Fourth
				<input type="text" id="fourth_article" name="fourth_article" value="<?php echo $_POST['fourth_article']; ?>" />
			</label>
			<br />
			<input type="password" id="password" name="password" /> <input type="submit" value="Page" />
			<input type="hidden" id="page" name="page" value="true" />
		</form>
	</body>
</html>