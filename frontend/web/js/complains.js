$(document).ready(function() {
    $('.post-report a').click(function() {
        var button = $(this),
            preloader = $(this).find('i'),
            params = {
                'id' : $(this).attr('data-id')
            };
            preloader.show();
            $.post('/post/default/complain', params, function(data) {
                preloader.hide;
                button.addClass('disabled');
                button.html(data.text);
            });
            return false;
    });
});
    