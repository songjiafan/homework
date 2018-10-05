$('.correct').on('click', function () {
    var id = $(this).attr('data-id');
    $('#correct_modal_' + id).modal({
        relatedTarget: this,
        onConfirm: function() {
            $.post('correct/correct', {
                'subjective_first_score': $('.first_' + id).val(),
                'subjective_second_score': $('.second_' + id).val(),
                'id': id
            },function (res) {
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

$('.correct2').on('click', function () {
    var id = $(this).attr('data-id');
    $('#correct_modal_' + id).modal({
        relatedTarget: this,
        onConfirm: function() {
            $.post('correct/offline', {
                'forum': $('.offline_' + id).val(),
                'id': id
            },function (res) {
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

