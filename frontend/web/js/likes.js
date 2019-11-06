$(document).ready(function () {
    $('.button-like').click(function () {
        var params = {
            'data-id': $(this).attr('data-id')
        }
        $.post('/post/default/like', params, function (data) {
            if (data.success) {
                $('.button-like').hide();
                $('.button-dislike').show();
                $('.likes span').text(data.likes);
            }
        });
        return false;
    })
    $('.button-dislike').click(function () {
        var params = {
            'data-id': $(this).attr('data-id')
        }
        $.post('/post/default/dislike', params, function (data) {
            $('.button-dislike').hide();
            $('.button-like').show();
            $('.likes span').text(data['likes']);
        });
        return false;
    })
})