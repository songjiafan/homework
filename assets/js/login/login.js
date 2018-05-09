var $loginBtn = $('.login');
var $resetBtn = $('.reset');

$resetBtn.on('click', function () {
    $('.user_id').val('');
    $('.pwd').val('');
});

$loginBtn.on('click', function () {
    var postData = {'user_id': $('.user_id').val(), 'password': $('.pwd').val()};
    $.post('login/do_login', postData , function (res) {
        if (!res.code) {
            $('#login-confirm').modal({relatedTarget: this});
            $('.am-modal-bd').html(res.message);
            setTimeout(function () {
                location.href = 'welcome'
            }, 800)
        } else {
            $('.am-modal-bd').html(res.message);
            $('#login-confirm').modal({relatedTarget: this});
        }
    }, 'json');
});
