$("#comments-form").submit(function(e){
	alert("script running");
	var values = $("#comments-form").serialize();
	var comment = $("#comment").val();
	if (comment.trim() == "" || comment == "Enter comment here...") {
		$("#comment").after("<div class=\"error-message\"><p>Your comment must be between 0 and 500 characters</p></div>");
		return false;
	}
	else {
		alert(comment);
		$.ajax({
			type: "POST",
			url: "/~rschreib/handlers/comment_handler.php",
			data: values,
			success: function() {
				$("#comments").append("<div><h4>You posted just now:</h4><p>"+escapeHTML(comment)+"</p></div>");
				$("#comment").val("");
			},
			error: function () {
				alert("FAILURE");
			}
		});
		e.preventDefault();
		return false;
	}
});

function escapeHTML(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};

	return text.replace(/[&<>"]/g, function(m) { return map[m]; });
}
