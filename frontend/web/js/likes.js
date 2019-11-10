$(document).ready(function () {
    $('.button-like').click(function () {
        var button = $(this),
            params = {
            'data-id': $(this).attr('data-id')
        }
        $.post('/post/default/like', params, function (data) {
            if (data.success) {
                button.hide();
                button.parent().find('.button-dislike').show();
                button.parents('.likes-container').find('.likes').text(data.likes);
            }
        });
        return false;
    })
    $('.button-dislike').click(function () {
        var button = $(this),
            params = {
            'data-id': $(this).attr('data-id')
        }
        $.post('/post/default/dislike', params, function (data) {
            button.hide();
            button.parent().find('.button-like').show();
            button.parents('.likes-container').find('.likes').text(data.likes);
        });
        return false;
    })
})