<?php
// header("Content-Type: text/css");

// Grid options.
$unit = "px";
$site = 1200;
$margin = 20;
$columns = 12;

// Grid magic.
$column = $site / $columns;
$words = array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve");

// Grid css.
$wordsCopy = $words;
echo "." . array_shift($wordsCopy) . "_column";
foreach($wordsCopy as $number => $word) {
	echo ",\n." . $word . "_columns";
}

?> {
	float: left;
	margin-left: <?php echo $margin . $unit; ?>;
}

<?php

foreach($words as $number => $word) {
	$is_plural = $number;
	if($is_plural) {
		echo "." . $word . "_columns";		
	} else {
		echo "." . $word . "_column";
	}
?>
 { width:<?php echo (($number + 1) * $column) - $margin . $unit; ?>; }
<?php
}
?>

.grid { width:<?php echo $site . $unit; ?>; padding-left:<?php echo $margin . $unit; ?>; margin:0 auto; }

.contained { margin-left:0; }

/* Grid-level decorations. */
.rule_at_right ul { padding-right:10px; border-right:1px solid #bbb; }
.rule_at_left { margin-left:10px; }
.three_columns.rule_at_right { width:300px; }
.nine_columns.rule_at_left { width:880px; }

/* Show a picture of the grid. */
.show.grid {
	background-image:url('img/grid.png');
	background-repeat:repeat-y;
}