$(function() {
    $('#new_note').on('click', function() {
        $('#my-prompt').modal({
            relatedTarget: this,
            onConfirm: function() {
                $.post('forum/add', {'title': $('#title').val(), 'content': $('#content').val()}, function (res) {
                    $('.am-modal-bd').html(res.message);
                    $('#forum-alert').modal({relatedTarget: this});
                    if (!res.code) {
                        setTimeout(function () {
                            location.href = 'forum'
                        }, 800)
                    }
                }, 'json')
            }
        });
    });

    $('#new_comment').on('click', function() {
        $('#comment-prompt').modal({
            relatedTarget: this,
            onConfirm: function() {
                $.post('forum/add_comment', {'forum_id': $('#container').attr('data-id'), 'content': $('#comment-content').val()}, function (res) {
                    $('.am-modal-bd').html(res.message);
                    $('#forum-alert').modal({relatedTarget: this});
                    if (!res.code) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 800)
                    }
                }, 'json')
            }
        });
    });

    $('.del_comment').on('click', function() {
        var id = $(this).attr('data-id')
        $('.del-message').html('确认删除此条评论吗');
        $('#del-alert').modal({
            relatedTarget: this,
            onConfirm: function() {
                $.post('forum/del_comment', {'id': id}, function (res) {
                    $('.am-modal-bd').html(res.message);
                    $('#forum-alert').modal({relatedTarget: this});
                    if (!res.code) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 800)
                    }
                }, 'json')
            }
        });
    });

    $('.del_forum').on('click', function() {
        var id = $(this).attr('data-id')
        $('#del-forum-alert').modal({
            relatedTarget: this,
            onConfirm: function() {
                $.post('forum/del_forum', {'id': id}, function (res) {
                    $('.am-modal-bd').html(res.message);
                    $('#forum-alert').modal({relatedTarget: this});
                    if (!res.code) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 800)
                    }
                }, 'json')
            }
        });
    });
});