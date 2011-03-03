<?php
// header("Content-Type: text/css");

// Grid options.
$columns = 12;

$unit = "px";
$site = 1200;
$margin = 20;

// Grid magic.
$column = $site / $columns;
$words = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve");

// Grid css.
foreach($words as $number => $word) {
	$is_plural = $number - 1;
	if($is_plural) {
		echo "." . $word . "_columns";
	} else {
		echo "." . $word . "_column";
	}
	
	$is_not_last = $words[$number + 1];
	if($is_not_last) echo ",\n";
}

?> {
	float: left;
	margin-left: <?php echo $margin . $unit; ?>;
}

<?php

foreach($words as $number => $word) {
	$is_plural = $number - 1;
	if($is_plural) {
		echo "." . $word . "_columns";		
	} else {
		echo "." . $word . "_column";
	}
?>
 { width:<?php echo $number * $column - $margin . $unit; ?>; }
<?php
}
?>

#issues #page { -webkit-box-shadow:-6px -6px 4px #ccc; border-left:solid #eee 2px; position:relative; left:35px; }

#page { width:<?php echo $site + $margin . $unit; ?>; margin:0 <?php echo $margin . $unit; ?>; }
#grid { width:<?php echo $site . $unit; ?>; padding-left:<?php echo $margin . $unit; ?>; }
.contained { margin-left:0; }

/* Grid-level decorations. */
.rule_at_right ul { padding-right:10px; border-right:1px solid #bbb; }
.rule_at_left { margin-left:10px; }
.three_columns.rule_at_right { width:300px; }
.nine_columns.rule_at_left { width:880px; }

/* Show a picture of the grid. */
.show#grid {
	background-image:url('img/grid.png');
	background-repeat:repeat-y;
}