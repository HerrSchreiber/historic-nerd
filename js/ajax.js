$(function() {
    $("#form").submit(function(){
        var values = $("form").serialize();
        var comment = $("#comment").val();
        console.log(values);
        $.ajax({
            type: "POST",
            url: "/~rschreib/handlers/comment_handler.php",
            data: values,
            success: function() {
                $("#comments").append("<div><h4>You posted just now:</h4><p>"+comment+"</p></div>");
                $("#comment").val("");
            },
            error: function () {
                alert("FAILURE");
            }
        });
        return false;
    });

});