// Columnar text flowing based on data attributes.
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
		var flexible_column_indices = new Array;
		var fixed_columns_total_height = 0;
		var column_heights = new Array;
		
		// Check for fixed heights on any of the target columns.
		$.each(columns, function(index, column){
			var column_min_height = column.css("min-height").replace('px', '');
			if(column_min_height == "0") {
				flexible_column_indices.push(index);
			} else {
				fixed_columns_total_height += parseInt(column_min_height);
				column_heights[index] = parseInt(column_min_height);
			}
		});
		
		// Average the remaining height over the reminaing, flexible columns to create final array of heights.
		var flexible_columns_height = Math.ceil((columns[0].height() - fixed_columns_total_height) / flexible_column_indices.length) + 21; // For some reason there needs to be an extra line?
		$.each(flexible_column_indices, function(flexible_column_index_index, flexible_column_index) {
			column_heights[flexible_column_index] = flexible_columns_height;
		});
console.log(column_heights);
		// Todo: Predict character distribution from pixel distribution, ensuring value is never under, and use as starting point.
		// For each column in order, move text into next column until it's short enough.
		var content = contents[article_index];
		$.each(columns, function(index, column){
// console.log("Flowing from column "+column.attr('data-column')+" to column "+$(columns[index+1]).attr('data-column')+" in article "+$(columns[index+1]).attr('data-article'));
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