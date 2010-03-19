<?php
	error_reporting(0);
	if($_POST['filed']) {
		if($_POST['password'] == '*ts01mdh') {
			
		} else {
			echo "Fuck off.";
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
			echo "Fuck off.";
		}
	} else {
		// $a1 = file('pages/a1');
		// $_POST['banner'] = $a1[0];
		// $_POST['cut'] = htmlentities($a1[1]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Inck ~ File</title>
		<style type="text/css">
			body { font-family:'Helvetica', 'Arial', sans-serif; font-size:11px; }
			input { margin:5px 0; }
			#filer label { display:block; }
			#banner { font-family:'Hoefler Text'; font-size:52px; width:880px; }
			#cut { width:880px; }
			#pager { margin-top:25px; width:150px; }
			#pager label input { display:block; width:25px; margin-right:25px; text-align:right; }
			#pager label { float:left; margin-right:5px; }
			#password { width:86px; }
		</style>
	</head>
	<body>
		<form method="post" id="filer">
			<label for="file">
				<input type="file" id="file" name="file" value="<?php echo $_POST['file']; ?>" />
			</label>
			<label for="date">
				<input type="text" id="date" name="date" value="<?php echo date('F jS, Y'); ?>" /> Date
			</label>
			<label for="banner">
				<input type="text" id="banner" name="banner" value="<?php echo $_POST['banner']; ?>" /> Banner
			</label>
			<label for="cut">
				<input type="text" id="cut" name="cut" value="<?php echo $_POST['cut']; ?>" /> Cut
			</label>
			<input type="password" id="password" name="password" /> <input type="submit" value="File" />
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