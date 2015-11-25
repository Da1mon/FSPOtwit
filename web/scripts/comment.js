/**
 * Created by Ilya on 12.11.2015.
 */
$(document).ready(function(){
    var $selector = $('#posts');
    $selector.on('click','.comment-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            data: "postId="+$(this).parent().data("post-id")+"&authorId="+$(this).parent().data("author-id"),
            success: function (data) {
                //$('div[data-id='+data.id+'] ul div').after(data.html);
                //$('div[data-id='+data.id+']+ul div li:last-child ').css('background-color','red');
                if(!$('div[data-post-id='+data.id+'] + * div').children().hasClass("comment-form")){
                    var $selector = $('div[data-post-id='+data.id+']');
                    if($selector.css('margin-bottom') == '20px'){
                        $selector.css('margin-bottom','0px');
                        $selector.after(
                            '<ul class="post-comment-wrap">' +
                            '<div class="post-comments">' +
                            data.html+
                            '<div>'+
                            '</ul>'
                        )
                    }else {
                        $('div[data-post-id='+data.id+']+ul div li:last-child ').after(data.html);
                    }
                }
            }
        });
    });
    $selector.on('mouseenter','.well',function (event){
        $(event.target).children('.delete-post-btn').show();
    });
    $selector.on('mouseleave','.well',function (event){
        $(event.target).children('.delete-post-btn').hide();
    });
    $selector.on('mouseenter','.delete-post-btn',function (event){
        $(event.target).css('opacity','1');
    });
    $selector.on('mouseleave','.delete-post-btn',function (event){
        $(event.target).css('opacity','0.3');
    });
    $selector.on('click','.delete-post-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('div[data-post-id=' + data + ']');
                    if ($selector.css('margin-bottom') != '20px') {
                        $('div[data-post-id=' + data + ']+ul').remove();
                    }
                    $selector.remove();
                }
            }
        });
    });

    $("#new_post").on("pjax:end", function() {
        $.pjax.reload({container: "#notes",timeout: 10000000000000});  //Reload GridView
    });
    $('#new_comment').on("pjax:end", function() {
        $.pjax.reload({container: "#notes",timeout: 10000000000000});  //Reload GridView
    });
});
//function handleAjaxLink(e) {
//
//    e.preventDefault();
//
//    var
//        $link = $(e.target),
//        callUrl = $link.attr('href'),
//        formId = $link.data('formId'),
//        onDone = $link.data('onDone'),
//        onFail = $link.data('onFail'),
//        onAlways = $link.data('onAlways'),
//        ajaxRequest;
//
//    var ajaxCallbacks = {
//        'simpleDone': function (response) {
//            // This is called by the link attribute 'data-on-done' => 'simpleDone'
//            console.dir(response);
//            $('#ajax_result_01').html(response.body);
//        }
//
//    };
//
//    ajaxRequest = $.ajax({
//        type: "post",
//        dataType: 'json',
//        url: callUrl,
//        data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
//    });
//
//    // Assign done handler
//    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
//        ajaxRequest.done(ajaxCallbacks[onDone]);
//    }
//
//    // Assign fail handler
//    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
//        ajaxRequest.fail(ajaxCallbacks[onFail]);
//    }
//
//    // Assign always handler
//    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
//        ajaxRequest.always(ajaxCallbacks[onAlways]);
//    }
//
//}
