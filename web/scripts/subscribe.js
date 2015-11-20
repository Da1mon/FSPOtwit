/**
 * Created by Ilya on 19.11.2015.
 */
$(document).ready(function(){
    var $selector = $('#user-info');
    $selector.on('click','#subscribe',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            data: "subscriptionId="+$(this).data("user-id"),
            success: function (data) {
                //alert('added');
                $('#subscribe').replaceWith(data);
            }
        });
    });
    $selector.on('click','#unsubscribe',function (event){
        event.preventDefault();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: $(this).attr('href'),
            data: "subscriptionId="+$(this).data("user-id"),
            success: function (data) {
                //alert('added');
                $('#unsubscribe').replaceWith(data);
            }
        });
    });
});