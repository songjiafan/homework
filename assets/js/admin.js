$('.del').on('click', function () {
    var id = $(this).attr('data-id');
    $.post('admin/del',{
        'id': id
    }, function (res) {
        if (res.code) {
            alert(res.message);
        } else {
            alert(res.message);
            window.location.reload()
        }
    }, 'json')
});

function checkReg(str) {
    return /^\d{9}$/.test(str)
}

$('.add').on('click', function () {
    $('#add_user').modal({
        relatedTarget: this,
        onConfirm: function() {
            if (!checkReg($('#uid').val())) {
                alert('学号必须是9位数字');
                return false;
            }
            $.post('admin/add', {
                'username': $('#username').val(),
                'uid': $('#uid').val(),
                'role': $("input[name='role']:checked").val(),
                'class': $('#class').val(),
                'enter_time': $('.enter_time').val(),
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
