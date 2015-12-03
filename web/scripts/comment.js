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
        $(event.target).children('.buttons-wrap').show();
    });
    $selector.on('mouseleave','.well',function (event){
        $(event.target).children('.buttons-wrap').hide();
    });
    $selector.on('mouseenter','.hidden-btn',function (event){
        $(event.target).css('opacity','1');
    });
    $selector.on('mouseleave','.hidden-btn',function (event){
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
                        $('div[data-post-id=' + data + ']+ul').animate( {opacity: "hide"}, 500, function(){this.remove()});
                    }
                    $selector.animate( {opacity: "hide"}, 500, function(){this.remove()});
                }
            }
        });
    });

    $selector.on('click','.edit-post-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('div[data-post-id=' + data.id + ']');
                    $selector.removeClass('padding-fix');
                    $selector.html(data.html);
                }
            }
        });
    });

    $selector.on('mouseenter','li',function (event){
        $(event.target).children('.buttons-wrap').show();
    });
    $selector.on('mouseleave','li',function (event){
        $(event.target).children('.buttons-wrap').hide();
    });

    $selector.on('click','.delete-comment-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('li[data-comment-id=' + data + ']');
                    if($selector.siblings().length < 1) {
                        var $commentWrap = $selector.parent().parent();
                        $commentWrap.animate({opacity: "hide"}, 500, function () {
                            $(this).prev().css('margin-bottom', '20px');
                            this.remove();
                        });

                    } else {
                        $selector.animate({opacity: "hide"}, 500, function () {
                            this.remove();
                        });
                    }
                }
            }
        });
    });

    $selector.on('click','.edit-comment-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('li[data-comment-id=' + data.id + ']');
                    $selector.css('padding','15px');
                    $selector.html(data.html);
                }
            }
        });
    });

    $selector.on('click','.like-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('div[data-post-id=' + data.id + '] div[data-btn=like]');
                    $selector.removeClass('hidden-btn like-btn');
                    $selector.addClass('showen-btn dislike-btn');
                    $selector.css('opacity', '1');
                    $selector.next().text(data.counter);
                    $selector.attr('href',data.href);
                }
            }
        });
    });

    $selector.on('click','.dislike-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('div[data-post-id=' + data.id + '] div[data-btn=like]');
                    $selector.removeClass('showen-btn dislike-btn');
                    $selector.addClass('hidden-btn like-btn');
                    $selector.css('opacity', '0.3');
                    if(data.counter == 0) {
                        $selector.next().text('');
                    } else {
                        $selector.next().text(data.counter);
                    }
                    $selector.attr('href',data.href);
                }
            }
        });
    });

    $selector.on('click','.like-comment-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('li[data-comment-id=' + data.id+ '] div[data-btn=like]');
                    $selector.removeClass('hidden-btn like-comment-btn');
                    $selector.addClass('showen-btn dislike-comment-btn');
                    $selector.css('opacity', '1');
                    $selector.next().text(data.counter);
                    $selector.attr('href',data.href);
                }
            }
        });
    });

    $selector.on('click','.dislike-comment-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    var $selector = $('li[data-comment-id=' + data.id + '] div[data-btn=like]');
                    $selector.removeClass('showen-btn dislike-comment-btn');
                    $selector.addClass('hidden-btn like-comment-btn');
                    $selector.css('opacity', '0.3');
                    if(data.counter == 0) {
                        $selector.next().text('');
                    } else {
                        $selector.next().text(data.counter);
                    }
                    $selector.attr('href',data.href);
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
    $('#edit_post').on("pjax:end", function() {
        $.pjax.reload({container: "#notes",timeout: 10000000000000});  //Reload GridView
    });
    $('#edit_comment').on("pjax:end", function() {
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
