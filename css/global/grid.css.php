<?php
// header("Content-Type: text/css");

// Grid options.
$unit = "px";
$site = 1200;
$margin = 10;
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

.grid { width:<?php echo $site . $unit; ?>; margin:0 auto; }

.contained { margin-left:0; }

/* Show the grid */
.show.grid {
	background-image:url('img/grid.png');
	background-repeat:repeat-y;
}