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

?> { float: left; margin-left: <?php echo $margin / 10 . 'em'; ?>; }
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
#page { width:<?php echo ($site + $margin) / 10 . 'em'; ?>; margin:0 auto; }
#grid { width:<?php echo $site / 10 . 'em'; ?>; padding-left:<?php echo $margin / 10 . 'em'; ?>; }
.contained { margin-left:0; } /* ToDo: Change 'contained' to 'first' or 'first_child'. Move in all markup to succeed 'block'? */
.rule_at_right ul { padding-right:1.9em; border-right:.1em solid #bbb; }

