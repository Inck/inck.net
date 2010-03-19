// Shitty manual reflowing as first step to awesome abstract reflowing with id data.
$(function() {
	// Flow main article second column.
	var contents = $("#article1_column1_extra20").html();
	var extra = 21 * 20; // Pretends to use the offset value in the ID.
	for(column_break = $("#article1_column1_extra20").html().length; // / 2; // This division is just a guess to speed it up.
	 	($("#article1_column1_extra20").height() - extra) > $("#article1_column2").height() / 2; // Subtract offset, also put double text in second column, to flow next into third column.
		column_break-- )
	{
		var moving_character = contents.charAt(column_break);
		if(moving_character == ' ') {
			var first_section = contents.substr(0, column_break) + "</p>";
			var second_section = "<p>" + contents.substr(column_break);
			$("#article1_column1_extra20").html(first_section);
			$("#article1_column2").html(second_section);
console.log("col2", "_", moving_character, $("#article1_column1_extra20").height() - extra, $("#article1_column2").height() / 2);
		} else if(moving_character == '<') {
			var first_section = contents.substr(0, column_break);
			var second_section = contents.substr(column_break);
			$("#article1_column1_extra20").html(first_section);
			$("#article1_column2").html(second_section);
console.log("col2", ">", moving_character, $("#article1_column1_extra20").height() - extra, $("#article1_column2").height() / 2);
		}
	}

	// Flow main article third column.
	var contents = $("#article1_column2").html();
	for(column_break = $("#article1_column2").html().length / 2; // This division is just a guess to speed it up.
	 	($("#article1_column2").height()) > $("#article1_column3").height();
		column_break-- )
	{
		var moving_character = contents.charAt(column_break);
		if(moving_character == ' ') {
			var first_section = contents.substr(0, column_break) + "</p>";
			var second_section = "<p>" + contents.substr(column_break);
			$("#article1_column2").html(first_section);
			$("#article1_column3").html(second_section);
console.log("col3", "_", moving_character, $("#article1_column2").height(), $("#article1_column3").height());
		} else if(moving_character == '<') {
			var first_section = contents.substr(0, column_break);
			var second_section = contents.substr(column_break);
			$("#article1_column2").html(first_section);
			$("#article1_column3").html(second_section);
console.log("col2", ">", moving_character, $("#article1_column2").height(), $("#article1_column3").height());
		}
	}
	
	// Flow lower two column.
	var contents = $("#article3_column1").html();
	for(column_break = $("#article3_column1").html().length / 2; // This division is just a guess to speed it up.
	 	$("#article3_column1").height() > $("#article3_column2").height();
		column_break-- )
	{
		var moving_character = contents.charAt(column_break);
		if(moving_character == ' ') {
			var first_section = contents.substr(0, column_break) + "</p>";
			var second_section = "<p>" + contents.substr(column_break);
			$("#article3_column1").html(first_section);
			$("#article3_column2").html(second_section);
console.log("col1", "_", moving_character, $("#article1_column1_extra20").height() - extra, $("#article1_column2").height() / 2);
		} else if(moving_character == '<') {
			var first_section = contents.substr(0, column_break);
			var second_section = contents.substr(column_break);
			$("#article3_column1").html(first_section);
			$("#article3_column2").html(second_section);
console.log("col2", ">", moving_character, $("#article1_column1_extra20").height() - extra, $("#article1_column2").height() / 2);
		}
		
	}
});
