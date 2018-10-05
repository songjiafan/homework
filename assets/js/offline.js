$('.add1').on('click', function () {
    $('#add_offline_teacher').modal({
        relatedTarget: this,
        onConfirm: function() {
            $.post('question/add_offline', {
                'title': $('#question_title').val(),
                'end_time': $('#end_time').val()
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

$('.del').on('click', function () {
    $.get('question/del_offline', {'id': $(this).attr('data-id')}, function (res) {
        if(res.code){
            alert(res.message)
        } else {
            alert(res.message)
            window.location.reload()
        }
    }, 'json')
})
