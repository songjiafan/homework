$('.reply').on('click', function() {
    var id = $(this).attr('data-id');
    var uid = $(this).attr('data-uid');
    $('#reply_' + id).modal({
        relatedTarget: this,
        onConfirm: function() {
            $.post('forum/reply', {
                'id': uid,
                'content': $('.content_' + id).val(),
            }, function (res) {
                if (res.code) {
                    alert(res.message)
                } else {
                    alert(res.message);
                    window.location.reload()
                }
            }, 'json')
        }
    });
});

$('.new').on('click', function() {
    $('#reply_new').modal({
        relatedTarget: this,
        onConfirm: function() {
            $.post('forum/add', {
                'content': $('.content_new').val(),
            }, function (res) {
                if (res.code) {
                    alert(res.message)
                } else {
                    alert(res.message);
                    window.location.reload()
                }
            }, 'json')
        }
    });
});
