/**
 * Created by Ilya on 20.11.2015.
 */
$(document).ready(function(){
    var $selector = $('#subscriptions');
    $selector.on('click','.unsubscribe-btn',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            success: function (data) {
                if(data != false) {
                    $('div[data-subscription-id=' + data + ']').remove();
                }
            }
        });
    });
});