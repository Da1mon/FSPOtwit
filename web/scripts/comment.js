/**
 * Created by Ilya on 12.11.2015.
 */
$(document).ready(function(){
    $("a.comment-btn").click(function() {
       alert($(this).parent().data("id"));
        //$(this).parent().css("background-color", 'red')
    });
});

