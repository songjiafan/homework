function checkReg(str) {
    return /^\d{6}$/.test(str)
}

$('.enter').on('click', function () {
    if (checkReg($('.old_pwd').val()) && checkReg($('.first_pwd').val()) && checkReg($('.second_pwd').val())) {
        $.post('password/check',{
            'password': $('.old_pwd').val()
        }, function (res) {
            if (res.code) {
                alert(res.message);
                return false
            } else {
                $.post('password/change',{
                    'new_password': $('.first_pwd').val()
                }, function (res) {
                    if (res.code) {
                        alert(res.message)
                    } else {
                        alert('修改成功！')
                        location.href = 'login/logout'
                    }
                }, 'json')
            }
        }, 'json')
    } else if ($('.first_pwd').val() !== $('.second_pwd').val()) {
        alert('两次密码不一致');
        return false
    } else {
        alert('请输入正确格式的密码（6位数字）');
        return false
    }
});

$('.reset').on('click', function () {
    $('.old_pwd').val('');
    $('.first_pwd').val('');
    $('.second_pwd').val('')
})
