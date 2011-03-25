// Awesome abstract reflowing with data attributes.
$(function(){
	var columns_count = 0;
	var articles = new Array;
	var columns = new Array;
	var contents = new Array;
	
	// Compile articles and their columns.
	$(".leader").each(function(){		
		if(article_number = $(this).attr("data-article")) {
			if($(this).attr("data-column") == 1) {
				columns_count = 0;
				columns = new Array;
				contents[article_number-1] = $(this).html();
			}
			columns[columns_count] = $(this);
			articles[article_number-1] = columns;
			columns_count++;
		}
	});

	// Flow articles into their columns.
	$.each(articles, function(article_index, columns){
		var column_heights = new Array;
		var flexible_columns = new Array;
		var fixed_columns_total_height = 0;
		
		// Check for fixed heights on any of the target columns.
		$.each(columns, function(index, column){
			if(column.css("max-height") == "none") {
				flexible_columns.push(index);
			} else {
				fixed_columns_total_height += column_heights[index] = column.height();
				column.css("max-height", "none");
			}
		});
		
		// Average the remaining height over the reminaing, flexible columns.
		flexible_columns_height = Math.round((columns[0].height() - fixed_columns_total_height) / flexible_columns.length);
		$.each(flexible_columns, function(flexible_column_index, flexible_column) {
			column_heights[flexible_column] = flexible_columns_height + 10; // For some reason there seems to be an extra 10px.
		});
// console.log(column_heights);
		// Todo: Predict character distribution from pixel distribution, ensuring value is never under, and use as starting point.
		// For each column in order, move text into next column until it's short enough.
		var content = contents[article_index];
		$.each(columns, function(index, column){
// console.log("Flowing from "+column.attr('data-column')+" to "+$(columns[index+1]).attr('data-column'));
			for(column_break = $(column).html().length;
			 	$(column).height() > column_heights[index];
				column_break--)
			{
// console.log($(column).height()+" > "+column_heights[index]+".");
				var moving_character = content.charAt(column_break);
				if(moving_character == ' ') {
					var this_section = content.substring(0, column_break) + "</p>";
					var next_section = "<p>" + content.substring(column_break);
					$(column).html(this_section);
					if($(columns[index+1]).html() != document) {
						$(columns[index+1]).html(next_section);
					}
				}
			}
// console.log($(column).height()+" < "+column_heights[index]+".");
			content = next_section;
		});
	});
});