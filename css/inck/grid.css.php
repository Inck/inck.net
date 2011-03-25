.space { height:1px; }
<?php
// header("Content-Type: text/css");

// Grid options.
$site = 1200;
$units = 12;
$margin = 20;

// Grid magic.
$unit = $site / $units;
$words = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve");

// Grid css.
foreach($words as $number => $word) {
	if($number == 1) {
		echo "." . $word . "_unit";
	} else {
		echo "." . $word . "_units";
	}
	
	$is_not_last = $words[$number + 1];
	if($is_not_last) echo ",\n";
}

?> {
	float: left;
	margin-left: <?php echo $margin / 10 . 'em'; ?>;
}

<?php
foreach($words as $number => $word) {
	if($number == 1) {
		echo "." . $word . "_unit";		
	} else {
		echo "." . $word . "_units";
	}
?>
 { width:<?php echo ($number * $unit - $margin) / 10 . 'em'; ?>; }
<?php
}
?>

#issues #page { -webkit-box-shadow:-.6em -.6em .4em #ccc; border:solid #eee; border-width:0 .2em; }

#page { width:<?php echo ($site + $margin) / 10 . 'em'; ?>; margin:0 <?php echo $margin / 10 . 'em'; ?>; }
#grid { width:<?php echo $site / 10 . 'em'; ?>; padding-left:<?php echo $margin / 10 . 'em'; ?>; }
.contained { margin-left:0; }

/* Grid-level decorations. */
.rule_at_right ul { padding-right:1em; border-right:.1em solid #bbb; }
.rule_at_left { margin-left:1em; }
.three_units.rule_at_right { width:29em; }
.nine_units.rule_at_left { width:88em; }

/* Show a picture of the grid. */
.show#grid {
	background-image:url('img/grid.png');
	background-repeat:repeat-y;
}